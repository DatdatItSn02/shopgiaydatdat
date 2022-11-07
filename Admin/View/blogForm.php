    <?php
    if (isset($_GET['act'])) :
        $act = $_GET['act'];
    switch ($act) {
        case 'addblog':
            echo '<h2 class="h3 mb-0 text-center w-100 text-gray-800">ADD BLOG</h2>';
        break;
        case 'editblog':
            echo '<h2 class="h3 mb-0 text-center w-100 text-gray-800">EDIT BLOG</h2>';
        break;
        }
    endif;
    ?>
        <div id="message"></div>
        <?php
        if (isset($_GET['act'])) :
            $act = $_GET['act'];
            switch ($act) {
                case 'addblog':
                    echo '<form id="addblogForm" enctype="multipart/form-data" class="mx-1 mx-md-4">';
                    break;
                case 'editblog':
                    echo '<form id="editblogForm" class="mx-1 mx-md-4">';
                    break;
            }
            if (isset($_GET['id'])) :
                $id = $_GET['id'];
                $blog = new Blog();
                $result = $blog->selectSingle($id);
                echo '<input value=' . $result['id'] . ' name="txtid" type="hidden" id="blogid" class="form-control" />';
            endif;
        ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="d-flex flex-row align-items-center mb-1">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="blogtitle">Title</label>
                    <?php
                        if ($act == 'addblog') :
                            echo '<input required name="txttitle" type="text" id="blogtitle" class="form-control" />';
                        else :
                            echo '<input required value="' . $result['title'] . '" name="txttitle" type="text" id="blogtitle" class="form-control" />';
                        endif;
                    ?>
                    <span class="form-error" id="blogtitle_err"></span>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-1">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="blogcategory">Category</label>
                    <select class="form-select" id="blogcategory" name="txtcategory" aria-label="Default select example">
                        <?php
                        $blogCategory = new BlogCategory();
                        $result2 = $blogCategory->selectAll();
                        while ($set2 = $result2->fetch()) :
                        ?>
                            <option value="<?php echo $set2['id']; ?>"><?php echo $set2['name']; ?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-1">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="blogsummary">Summary</label>
                    <?php
                    if ($act == 'addblog') :
                        echo '<textarea name="txtsummary" id="blogsummary" class="form-control"></textarea>';
                    else :
                        echo '<textarea name="txtsummary" id="blogsummary" class="form-control">' . $result['summary'] . '</textarea>';
                    endif;
                    ?>
                    <span class="form-error" id="blogsummary_err"></span>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-1">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="blogviewnumber">Views</label>
                    <?php
                    if ($act == 'addblog') :
                        echo '<input required name="txtviewnumber" type="number" value="0" min="0" id="blogviewnumber" class="form-control" />';
                    else :
                        echo '<input required value="' . $result['view_number'] . '" name="txtviewnumber" type="number" id="blogviewnumber" class="form-control" />';
                    endif;
                    ?>
                    <span class="form-error" id="blogviewnumber_err"></span>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-1">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="blogtag">Tags</label>
                    <input type="hidden" name="txttag" type="text" id="blogtaghidden" value="<?php echo $result['tag'] ?>" class="form-control">
                    <?php
                    // if ($act == 'addblog') :
                    //     echo '<input required name="txttag" type="text" id="blogtag" class="form-control"/>';
                    // else :
                    //     echo '<input required value="' . $result['tag'] . '" name="txttag" type="text" id="blogtag" class="form-control" />';
                    // endif;
                    ?>
                    <div class="bg-light">
                        <div id="tags" style="display:inline-block;">
                            <?php
                                if($act == 'editblog'){
                                    $tagsList = explode(':',$result['tag']);
                                    foreach($tagsList as $tag):
                                    ?>
                                    <span class="badge bg-success p-1 mx-1" id="tagId=<?php echo $tag?>"><?php echo $tag?><button type="button" onclick="deleteTag('<?php echo $tag;?>','<?php echo $tag;?>')" class="bg-success" style="border: none;"> x </button></span>
                                    <?php 
                                    endforeach;
                                }
                            ?>
                        </div>
                        <i class="fa-solid fa-circle-plus"  data-bs-toggle="modal" data-bs-target="#myModal"></i> 
                        <div class="modal" id="myModal">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add a tag</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input class="form-control" id="taginput" type="text">
                            </div>
                            <div class="modal-footer">
                                <button type="button"  data-bs-dismiss="modal" id="addtagbtn" class="btn btn-success">Add</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                            </div>
                        </div>
                        </div>
                    </div>


                    <span class="form-error" id="blogtag_err"></span>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-1">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="blogtag">Publish ?</label>
                    <?php
                    if ($act == 'editblog') :
                        if($result['tag']=="Yes")
                        {
                            echo '<select class="form-select" name="txtispublish" id="blogispublish">
                                        <option value="No">No</option>
                                        <option value="Yes" selected>Yes</option>
                                    </select>';
                        }
                        else 
                        {
                            echo '<select class="form-select" name="txtispublish" id="blogispublish">
                                        <option value="No" selected>No</option>
                                        <option value="Yes">Yes</option>
                                    </select>';
                        }
                    else:
                    ?>
                    <select class="form-select" name="txtispublish" id="blogispublish">
                        <option value="No" selected>No</option>
                        <option value="Yes">Yes</option>
                    </select>
                    <?php
                    endif;
                    ?>
                    <span class="form-error" id="blogtag_err"></span>
                </div>
            </div>

            <?php
            if ($act == 'addblog') :
            ?>
                <div class="d-flex flex-row align-items-center mb-1">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="blogthumbnail">Thumbnail</label>
                        <input required name="txtimage" type="file" id="blogthumbnail" class="form-control" />
                    </div>
                </div>
            <?php
            else :
            ?>
                <div class="d-flex flex-row align-items-center mb-1">
                    <div class="form-outline flex-fill mb-0">
                        <img src="../../assets/img/blogs/<?php echo $result['thumbnail']?>" alt="" width="50" height="50">
                        <input type="hidden" id="blogthumbnailold" name="txtimageold" value="<?php echo $result['thumbnail'] ?>">
                        <label class="form-label" for="blogthumbnail">Thumbnail</label>
                        <input required name="txtimage" type="file" id="blogthumbnail" class="form-control" />
                    </div>
                </div>
            <?php
            endif;
            ?>

            <div class="form-button">
                <a href="/Admin/index.php?action=dashboard&act=blogs" class="btn btn-danger ml-3 mt-3" style="float: right;"><b>Close</b></a>
            <?php
            switch ($act) {
                case 'addblog':
                    echo '<button class="btn btn-success m-3" id="addsubmitbtn" style="float: right;" type="button"><b>Add blog</b></button>';
                    break;
                case 'editblog':
                    echo '<button class="btn btn-warning m-3" id="editsubmitbtn" style="float: right;" type="button"><b>Edit blog</b></button>';
                    break;
            }
        endif;
            ?>
            </div>
        </div>
        <div class="col-lg-8">   
            <div class="d-flex flex-row align-items-center mb-1">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="blogcontent">Content</label>
                    <?php
                    if ($act == 'addblog') :
                        echo '<textarea id="blogcontent" class="form-control" name="txtcontent"></textarea>';
                    else :
                        echo '<textarea id="blogcontent" class="form-control" name="txtcontent">' . $result['content'] . '</textarea>';
                    endif;
                    ?>
                    <span class="form-error" id="blogcontent_err"></span>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    // Content
    tinymce.init({
    selector: '#blogcontent',
    height: 350,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste imagetools wordcount'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });


    var tags = '';
    $(document).ready(function() {
        $('#blogtitle').on('input', function() {
            checkBlogTitle();
        });
        $('#blogviewnumber').on('input', function() {
            checkBlogViewNumber();
        });
        $('#blogsummary').on('input', function() {
            checkBlogSummary();
        });
        
        $('#addtagbtn').click(function() {
            let tag = $('#taginput').val();
            if(tag)
            {
                if(tags)
                {
                    tags += ':'+tag;
                }
                else
                {
                    tags += tag;
                }
                let id = tags.length;
                document.getElementById('blogtaghidden').value = tags;
                document.getElementById('tags').innerHTML += `<span class="badge bg-success p-1 mx-1" id="${"tagId="+id}"> ${tag} <button type="button" onclick="deleteTag('${tag}',${id})" class="bg-success" style="border: none;"> x </button></span>`;
                document.getElementById('taginput').value="";
            }
        })
        $('#addsubmitbtn').click(function() {
            if (!checkBlogTitle() && !checkBlogViewNumber() && !checkBlogSummary()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else if (!checkBlogTitle() || !checkBlogViewNumber() || !checkBlogSummary()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else {
                console.log("ok");
                $("#message").html("");
                var title      = $('#blogtitle').val();
                var categoryId = $('#blogcategory').val();
                var summary    = $('#blogsummary').val();
                var tag        = $('#blogtaghidden').val();
                var ispublish  = $('#blogispublish').val();
                var content    = tinyMCE.get('blogcontent').getContent();
                var viewNumber = $('#blogviewnumber').val();
                var thumbnail  = $('#blogthumbnail')[0].files[0];
                // var form = $('#addblogForm')[0];
                var data = new FormData();

                data.append('txttitle',title);
                data.append('txtcategory',categoryId);
                data.append('txtsummary',summary);
                data.append('txttag',tag);
                data.append('txtispublish',ispublish);
                data.append('txtcontent',content);
                data.append('txtviewnumber',viewNumber);
                data.append('txtimage',thumbnail);

                $.ajax({
                    type: "POST",
                    url: "/Admin/index.php?action=dashboard&act=addblog_action",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    beforeSend: function() {
                        $('#addsubmitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                        $('#addsubmitbtn').attr("disabled", true);
                        $('#addsubmitbtn').css({
                            "border-radius": "50%"
                        });
                    },
                    success: function(data) {
                        $('#message').html(data);
                    },
                    complete: function() {
                        setTimeout(function() {
                            $('#myform').trigger("reset");
                            $('#addsubmitbtn').html('Submit');
                            $('#addsubmitbtn').attr("disabled", false);
                            $('#addsubmitbtn').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                });
            }
        });
        $('#editsubmitbtn').click(function() {
            if (!checkBlogTitle() && !checkBlogViewNumber() && !checkBlogSummary()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else if (!checkBlogTitle() || !checkBlogViewNumber() || !checkBlogSummary()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else {
                console.log("ok");
                $("#message").html("");
                var id      = $('#blogid').val();
                var title      = $('#blogtitle').val();
                var categoryId = $('#blogcategory').val();
                var summary    = $('#blogsummary').val();
                var tag        = $('#blogtaghidden').val();
                var ispublish  = $('#blogispublish').val();
                var content    = tinyMCE.get('blogcontent').getContent();
                var viewNumber = $('#blogviewnumber').val();
                var thumbnailOld = $('#blogthumbnailold').val();
                var thumbnail  = $('#blogthumbnail')[0].files[0];
                console.log(thumbnail);
                // var form = $('#addblogForm')[0];
                var data = new FormData();
                data.append('txtid',id)
                data.append('txttitle',title);
                data.append('txtcategory',categoryId);
                data.append('txtsummary',summary);
                data.append('txttag',tag);
                data.append('txtispublish',ispublish);
                data.append('txtcontent',content);
                data.append('txtviewnumber',viewNumber);
                data.append('txtimageold',thumbnailOld);
                data.append('txtimage',thumbnail);

                $.ajax({
                    type: "POST",
                    url: "/Admin/index.php?action=dashboard&act=editblog_action",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    beforeSend: function() {
                        $('#addsubmitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                        $('#addsubmitbtn').attr("disabled", true);
                        $('#addsubmitbtn').css({
                            "border-radius": "50%"
                        });
                    },
                    success: function(data) {
                        $('#message').html(data);
                    },
                    complete: function() {
                        setTimeout(function() {
                            $('#myform').trigger("reset");
                            $('#addsubmitbtn').html('Submit');
                            $('#addsubmitbtn').attr("disabled", false);
                            $('#addsubmitbtn').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                });
            }
        });
    });
    function deleteTag(name,id) {
        console.log('1');
        let tagId = "tagId="+id;
        let tagsHidden =  document.getElementById('blogtaghidden').value;
        let flag = tagsHidden.indexOf(name);
        if(flag){
            var newTags = tagsHidden.replace(':'+name,'');
        }
        else 
        {   
            if(tagsHidden.length == name.length){
                var newTags = tagsHidden.replace(name,'');
            }
            else 
            {
                var newTags = tagsHidden.replace(name+':','');
            }
        }
        tags = newTags;
        document.getElementById('blogtaghidden').value = newTags;
        document.getElementById(`${tagId}`).remove();
    }
    function checkBlogTitle() {
        var user = $('#blogtitle').val();
        if ($('#blogtitle').val() == "") {
            $('#blogtitle_err').html('Tiêu đề không được để trống');
            return false;
        } else {
            $('#blogtitle_err').html('');
            return true;
        }
    }
    function checkBlogSummary() {
        var user = $('#blogsummary').val();
        if ($('#blogsummary').val() == "") {
            $('#blogsummary_err').html('Tóm tắt không được để trống');
            return false;
        } else {
            $('#blogsummary_err').html('');
            return true;
        }
    }
    function checkBlogViewNumber() {
        var pattern3 = /^[0-9 ]+$/;
        var quantity = $('#blogviewnumber').val();
        if (quantity == "") {
            $('#blogviewnumber_err').html('Số lượt xem không được để trống');
            return false;
        } else if (quantity < 0) {
            $('#blogviewnumber_err').html('Số lượt xem có giá trị lớn hơn 0');
            return false;
        } else {
            $('#blogviewnumber_err').html('');
            return true;
        }
    }
</script>