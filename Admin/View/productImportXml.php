<div class="container">
    <form action="/Admin/index.php?action=dashboard&act=importxmlproduct_action" method="post" enctype="multipart/form-data" class="mx-1 mx-md-4">

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="productImportXml">Products XML File:</label>
                <input required name="file" type="file" id="productImportXml" class="form-control" />
            </div>
        </div>

        <div class="form-button">
            <a href="/Admin/index.php?action=dashboard&act=products" class="btn btn-danger ml-3 mt-3" style="float: right;" ><b>Close</b></a>
            <button class="btn btn-warning m-3" style="float: right;" name="btnSubmit" type="submit"><b>Confirm</b></button>
        </div>

    </form>
</div>