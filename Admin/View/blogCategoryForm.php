<div class="container">
    <?php
    if (isset($_GET['act'])) :
        $act = $_GET['act'];
        switch ($act) {
            case 'addblogcategory':
                echo '<h2 class="h3 mb-0 text-center w-100 text-gray-800">ADD BLOG CATEGORY</h2>';
                break;
            case 'editblogcategory':
                echo '<h2 class="h3 mb-0 text-center w-100 text-gray-800">EDIT BLOG CATEGORY</h2>';
                break;
        }
    endif;
    ?>
    <div id="message"></div>
    <?php
    if (isset($_GET['act'])) :
        $act = $_GET['act'];
        switch ($act) {
            case 'addblogcategory':
                echo '<form id="addblogcategoryform" method="post" action="/admin/index.php?action=dashboard&act=addblogcategory_action" class="mx-1 mx-md-4">';
                break;
            case 'editblogcategory':
                echo '<form id="editblogcategoryform" method="post" action="/admin/index.php?action=dashboard&act=editblogcategory_action" class="mx-1 mx-md-4">';
                break;
        }
        if (isset($_GET['id'])) :
            $id = $_GET['id'];
            $blogCategory = new BlogCategory();
            $result = $blogCategory->selectSingle($id);
            echo '<input value=' . $result['id'] . ' name="txtid" type="hidden" id="blogcategoryId" class="form-control" />';
        endif;
    ?>
        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="blogcategoryName">Name</label>
                <?php
                if ($act == 'addblogcategory') :
                    echo '<input required name="txtname" type="text" id="blogcategoryName" class="form-control" />';
                else :
                    echo '<input required value="' . $result['name'] . '" name="txtname" type="text" id="blogcategoryName" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="blogcategoryName_err"></span>
            </div>
        </div>

        <div class="form-button">
            <a href="/Admin/index.php?action=dashboard&act=blogcategorys" class="btn btn-danger ml-3 mt-3" style="float: right;"><b>Close</b></a>
        <?php
        switch ($act) {
            case 'addblogcategory':
                echo '<button class="btn btn-success m-3" style="float: right;" type="submit" id="addsubmitbtn"><b>Add Category</b></button>';
                break;
            case 'editblogcategory':
                echo '<button class="btn btn-warning m-3" style="float: right;" type="submit" id="editsubmitbtn"><b>Edit Category</b></button>';
                break;
        }
    endif;
        ?>
        </div>
        </form>
</div>