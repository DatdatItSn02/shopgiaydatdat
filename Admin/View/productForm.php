<div class="container">
    <div id="message"></div>
    <?php
    if (isset($_GET['act'])) :
        $act = $_GET['act'];
        switch ($act) {
            case 'addproduct':
                echo '<form id="addProductForm" enctype="multipart/form-data" class="mx-1 mx-md-4">';
                break;
            case 'editproduct':
                echo '<form id="editProductForm" class="mx-1 mx-md-4">';
                break;
        }
        if (isset($_GET['id'])) :
            $id = $_GET['id'];
            $product = new product();
            $result = $product->selectSingle($id);
            echo '<input value=' . $result['id'] . ' name="txtid" type="hidden" id="userId" class="form-control" />';
            echo '<a href="/Admin/index.php?action=dashboard&act=editproductimage&id=' . $result['id'] . '" class="btn btn-warning mb-3"><b>Đổi hình ảnh</b></a>';
        endif;
    ?>
        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="productName">Name</label>
                <?php
                if ($act == 'addproduct') :
                    echo '<input required maxlength="100" name="txtname" type="text" id="productName" class="form-control" />';
                else :
                    echo '<input required maxlength="100" value="' . $result['name'] . '" name="txtname" type="text" id="productName" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="productName_err"></span>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="productPrice">Price</label>
                <?php
                if ($act == 'addproduct') :
                    echo '<input required min="0" name="txtprice" type="number" id="productPrice" class="form-control" />';
                else :
                    echo '<input required min="0" value="' . $result['price'] . '" name="txtprice" type="number" id="productPrice" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="productPrice_err"></span>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="productDiscount">Discount Percent</label>
                <?php
                if ($act == 'addproduct') :
                    echo '<input required min="0" max="1" step="0.01" name="txtdiscountpercent" type="number" id="productDiscount" class="form-control" />';
                else :
                    echo '<input required min="0" max="1" step="0.01" value="' . $result['discountPercent'] . '" name="txtdiscountpercent" type="number" id="productDiscount" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="productDiscount_err"></span>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="productCategory">Category</label>
                <select class="form-select" name="txtcategory" aria-label="Default select example">
                    <?php
                    $category = new Category();
                    $result2 = $category->selectAll();
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
                <label class="form-label" for="productColor">Color</label>
                <?php
                if ($act == 'addproduct') :
                    echo '<input required maxlength="20" name="txtcolor" type="text" id="productColor" class="form-control" />';
                else :
                    echo '<input required maxlength="20" value="' . $result['color'] . '" name="txtcolor" type="text" id="productColor" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="productColor_err"></span>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="productSize">Size</label>
                <?php
                if ($act == 'addproduct') :
                    echo '<input required name="txtsize" type="number" id="productSize" class="form-control" />';
                else :
                    echo '<input required value="' . $result['size'] . '" name="txtsize" type="number" id="productSize" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="productSize_err"></span>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="productQuantity">Quantity</label>
                <?php
                if ($act == 'addproduct') :
                    echo '<input required step="0.1" name="txtquantity" type="number" id="productQuantity" class="form-control" />';
                else :
                    echo '<input required step="0.1" value="' . $result['quantity'] . '" name="txtquantity" type="number" id="productQuantity" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="productQuantity_err"></span>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="productDescription">Description</label>
                <?php
                if ($act == 'addproduct') :
                    echo '<textarea required name="txtdescription" type="text" id="productDescription" class="form-control"></textarea>';
                else :
                    echo '<textarea required name="txtdescription" type="text" id="productDescription" rows="5" class="form-control">' . $result['description'] . '</textarea>';
                endif;
                ?>
            </div>
        </div>
        <?php
        if ($act == 'addproduct') :
        ?>
            <div class="d-flex flex-row align-items-center mb-1">
                <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="productImage">Image</label>
                    <input required name="txtimage" type="file" id="productImage" class="form-control" />
                </div>
            </div>
        <?php
        endif;
        ?>

        <div class="form-button">
            <a href="/Admin/index.php?action=dashboard&act=products" class="btn btn-danger ml-3 mt-3" style="float: right;"><b>Close</b></a>
        <?php
        switch ($act) {
            case 'addproduct':
                echo '<button class="btn btn-success m-3" id="addsubmitbtn" style="float: right;" type="button"><b>Add Product</b></button>';
                break;
            case 'editproduct':
                echo '<button class="btn btn-warning m-3" id="editsubmitbtn" style="float: right;" type="button"><b>Edit Product</b></button>';
                break;
        }
    endif;
        ?>
        </div>
        </form>
</div>

<script>
    $(document).ready(function() {
        $('#productName').on('input', function() {
            checkProductName();
        });
        $('#productPrice').on('input', function() {
            checkPrice();
        });
        $('#productDiscount').on('input', function() {
            checkDiscount();
        });
        $('#productColor').on('input', function() {
            checkColor();
        });
        $('#productSize').on('input', function() {
            checkSize();
        });
        $('#productQuantity').on('input', function() {
            checkQuantity();
        });

        $('#addsubmitbtn').click(function() {
            if (!checkProductName() && !checkPrice() && !checkDiscount() && !checkColor() && !checkSize() && !checkQuantity()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else if (!checkProductName() || !checkPrice() || !checkDiscount() || !checkColor() || !checkSize() || !checkQuantity()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else {
                console.log("ok");
                $("#message").html("");
                var form = $('#addProductForm')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "/Admin/index.php?action=dashboard&act=addproduct_action",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    beforeSend: function() {
                        $('#submitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                        $('#submitbtn').attr("disabled", true);
                        $('#submitbtn').css({
                            "border-radius": "50%"
                        });
                    },

                    success: function(data) {
                        $('#message').html(data);
                    },
                    complete: function() {
                        setTimeout(function() {
                            $('#myform').trigger("reset");
                            $('#submitbtn').html('Submit');
                            $('#submitbtn').attr("disabled", false);
                            $('#submitbtn').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                });
            }
        });
        
        $('#editsubmitbtn').click(function() {
            if (!checkProductName() && !checkPrice() && !checkDiscount() && !checkColor() && !checkSize() && !checkQuantity()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else if (!checkProductName() || !checkPrice() || !checkDiscount() || !checkColor() || !checkSize() || !checkQuantity()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else {
                console.log("ok");
                $("#message").html("");
                var form = $('#editProductForm')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "/Admin/index.php?action=dashboard&act=editproduct_action",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    beforeSend: function() {
                        $('#submitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                        $('#submitbtn').attr("disabled", true);
                        $('#submitbtn').css({
                            "border-radius": "50%"
                        });
                    },

                    success: function(data) {
                        $('#message').html(data);
                    },
                    complete: function() {
                        setTimeout(function() {
                            $('#myform').trigger("reset");
                            $('#submitbtn').html('Submit');
                            $('#submitbtn').attr("disabled", false);
                            $('#submitbtn').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                });
            }
        });
    });
    function checkProductName() {
        var user = $('#productName').val();
        if ($('#productName').val() == "") {
            $('#productName_err').html('Tên không được để trống');
            return false;
        } else if ($('#productName').val().length < 4) {
            $('#productName_err').html('Tên phải có từ 4 kí tự trở lên');
            return false;
        } else {
            $('#productName_err').html('');
            return true;
        }
    }

    function checkPrice() {
        var pattern1 = /^[0-9. ]+$/;
        var Price = $('#productPrice').val();
        var validPrice = pattern1.test(Price);
        if (Price == "") {
            $('#productPrice_err').html('Price không được để trống');
            return false;
        } else if (!validPrice) {
            $('#productPrice_err').html('Price không hợp lệ');
            return false;
        } else if (Price < 0) {
            $('#productPrice_err').html('Price Percent có giá trị lớn hơn 0');
            return false;
        } else {
            $('#productPrice_err').html('');
            return true;
        }
    }

    function checkDiscount() {
        var pattern2 = /^[0-9. ]+$/;
        var discount = $('#productDiscount').val();
        var validDiscount = pattern2.test(discount);
        if (discount == "") {
            $('#productDiscount_err').html('Discount Percent không được để trống');
            return false;
        } else if (!validDiscount) {
            $('#productDiscount_err').html('Discount Percent không hợp lệ');
            return false;
        } else if (discount > 1 || discount < 0) {
            $('#productDiscount_err').html('Discount Percent có giá trị từ 0-1');
            return false;
        } else {
            $('#productDiscount_err').html('');
            return true;
        }
    }

    function checkColor() {
        if ($('#productColor').val() == "") {
            $('#productColor_err').html('Màu không được để trống');
            return false;
        } else {
            $('#productColor_err').html('');
            return true;
        }
    }

    function checkSize() {
        var pattern3 = /^[0-9. ]+$/;
        var size = $('#productSize').val();
        if (size == "") {
            $('#productSize_err').html('Size không được để trống');
            return false;
        } else {
            $('#productSize_err').html('');
            return true;
        }
    }

    function checkQuantity() {
        var pattern3 = /^[0-9. ]+$/;
        var quantity = $('#productQuantity').val();
        if (quantity == "") {
            $('#productQuantity_err').html('Số lượng không được để trống');
            return false;
        } else if (quantity < 0) {
            $('#productQuantity_err').html('Quantity có giá trị lớn hơn 0');
            return false;
        } else {
            $('#productQuantity_err').html('');
            return true;
        }
    }
</script>