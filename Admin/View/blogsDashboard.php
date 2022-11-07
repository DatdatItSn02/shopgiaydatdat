<div class="mb-3">
    <form id="searchId" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 mw-100 navbar-search">
        <div class="row">
            <div class="input-group">
                <input id="searchInput" type="text" class="form-control border-1 small" placeholder="Search products by name..." aria-label="Search" aria-describedby="basic-addon2" name="txtsearch">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" disabled>
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
            <div class="input-group">
                <!-- <select id="selectCategory" class="form-select form-control border-1 small" style="display:inline-block; min-width:200px;" name="txtcategory">
                    <option value="all">Tất cả</option>
                    <?php
                        $category = new Category();
                        $allCategory = $category->selectAll();
                        while($option = $allCategory->fetch()):
                    ?>
                    <option value="<?php echo $option['id'] ?>"><?php echo $option['name'] ?></option>
                    <?php
                        endwhile;
                    ?>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="categoryBtn">
                        <i class="fa fa-filter"></i> Lọc
                    </button>
                </div> -->
            </div>
        </div>

    </form>
    <div style="float: right;">
        <a href="/Admin/index.php?action=dashboard&act=addblog" class="btn btn-success">Tạo bài viết</a>
    </div>
</div>
<div class="w-100" id="data" style="overflow-x: auto; white-space:nowrap;">
    <table id="datatablesSimple" class="table text-center">
        <thead class="table-dark">
            <th>Id</th>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Summary</th>
            <th>Author</th>
            <th>View Number</th>
            <th>Tags</th>
            <th></th>
            <th></th>
        </thead>
        <?php
        $blog  = new Blog();
        $results  = $blog->selectAllDesc();
        while ($set = $results->fetch()) :
            $staff = new Staff();
            $author = $staff->selectSingle($set['author_id']);
            $authorName = $author['name'];
            $authorImage = $author['image'];
            $tags = explode(':',$set['tag']);
        ?>
            <tbody>
                <td><?php echo $set['id'] ?></td>
                <td><img src="../../assets/img/blogs/<?php echo $set['thumbnail'] ?>" width="50" alt=""></td>
                <td><?php echo substr($set['title'],0,30). '...' ?></td>
                <td><?php echo substr($set['summary'],0,30). '...'?></td>
                <td><?php echo $authorName ?></td>
                <td><?php echo $set['view_number'] ?></td>
                <td><?php
                foreach($tags as $tag)
                {
                    echo '<span class="badge bg-primary mx-1">'.$tag.'</span>';
                }
                ?></td>
                <td><a href="/Admin/index.php?action=dashboard&act=editblog&id=<?php echo $set['id'] ?>" class="btn btn-warning">Sửa</a></td>
                <td><a href="/Admin/index.php?action=dashboard&act=deleteblog&id=<?php echo $set['id'] ?>" onclick="return confirm('Bạn có chắc không ?')" class="btn btn-danger">Xóa</a></td>
            </tbody>
        <?php
        endwhile;
        ?>
    </table>
</div>
<script>
    // $(document).ready(function() {
    //     $('#searchInput').on('input', function() {
    //         var form = document.querySelector('#searchId');
    //         var data = new FormData(form);
    //         $.ajax({
    //             type: "POST",
    //             url: "View/ajaxTemplate/productTable.php",
    //             data: data,
    //             processData: false,
    //             contentType: false,
    //             cache: false,
    //             async: false,
    //             success: function(data) {
    //                 $('#data').html(data);
    //             }
    //         })
    //     });
    //     $('#categoryBtn').on('click', function() {
    //         var form = document.querySelector('#searchId');
    //         var data = new FormData(form);
    //         $.ajax({
    //             type: "POST",
    //             url: "View/ajaxTemplate/productTable.php",
    //             data: data,
    //             processData: false,
    //             contentType: false,
    //             cache: false,
    //             async: false,
    //             success: function(data) {
    //                 $('#data').html(data);
    //             }
    //         })
    //     });
    // });

</script>