<?php
    if(isset($_GET['id'])) :
        $id = $_GET['id'];
    endif;
?>
<div class="container">
    <form action="/Admin/index.php?action=dashboard&act=editproductimage_action" method="post" enctype="multipart/form-data" class="mx-1 mx-md-4">

        <input value="<?php echo $id ?>" name="txtid" type="hidden" id="userId" class="form-control" />

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="userChangePassword">New Image</label>
                <input required name="txtimage" type="file" id="userChangePassword" class="form-control" />
            </div>
        </div>

        <div class="form-button">
            <a href="/Admin/index.php?action=dashboard&act=editproduct&id=<?php echo $id ?>" class="btn btn-danger ml-3 mt-3" style="float: right;" ><b>Close</b></a>
            <button class="btn btn-warning m-3" style="float: right;" type="submit"><b>Confirm</b></button>
        </div>
    </form>
</div>