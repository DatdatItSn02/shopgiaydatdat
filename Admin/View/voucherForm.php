<div class="container">
<?php
if (isset($_GET['act'])) :
    $act = $_GET['act'];
  switch ($act) {
    case 'addvoucher':
        echo '<h2 class="h3 mb-0 text-center w-100 text-gray-800">ADD VOUCHER</h2>';
    break;
    case 'editvoucher':
        echo '<h2 class="h3 mb-0 text-center w-100 text-gray-800">EDIT VOUCHER</h2>';
    break;
    }
endif;
?>
<div id="message"></div>
    <?php
    if (isset($_GET['act'])) :
        $act = $_GET['act'];
        switch ($act) {
            case 'addvoucher':
                echo '<form id="addvoucherform" class="mx-1 mx-md-4">';
            break;
            case 'editvoucher':
                echo '<form id="editvoucherform" class="mx-1 mx-md-4">';
            break;
        }
        if (isset($_GET['id'])) :
            $id = $_GET['id'];
            $voucher = new Voucher();
            $result = $voucher->selectSingle($id);
            echo '<input value=' . $result['id'] . ' name="txtid" type="hidden" id="voucherId" class="form-control" />';
        endif;
    ?>
        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherName">Name</label>
                <?php
                if ($act == 'addvoucher') :
                    echo '<input required maxlength="100" name="txtname" type="text" id="voucherName" class="form-control" />';
                else :
                    echo '<input required maxlength="100" value="' . $result['name'] . '" name="txtname" type="text" id="voucherName" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="voucherName_err"></span> 
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="vouchercode">Code</label>
                <?php
                if ($act == 'addvoucher') :
                    echo '<input required name="txtcode" type="text" id="voucherCode" class="form-control" />';
                else :
                    echo '<input required value="' . $result['code'] . '" name="txtcode" type="text" id="voucherCode" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="voucherCode_err"></span> 
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="vouchertype">Type</label>
                <select class="form-select" name="txttypeid" aria-label="Default select example">
                    <?php
                    $voucherType = new VoucherType();
                    $types = $voucherType->selectAll();
                    if ($act == 'editvoucher') :
                        while ($setType = $types->fetch()) :
                            if ($setType['id'] == $result['type_id']) :
                    ?>
                                <option value="<?php echo $setType['id']; ?>" selected><?php echo $setType['name']; ?></option>
                            <?php
                            else :
                            ?>
                                <option value="<?php echo $setType['id']; ?>"><?php echo $setType['name']; ?></option>
                            <?php
                            endif;
                        endwhile;
                    else :
                        while ($setType = $types->fetch()) :
                            ?>
                            <option value="<?php echo $setType['id']; ?>"><?php echo $setType['name']; ?></option>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherValue">Value (Depend on voucher type)</label>
                <?php
                if ($act == 'addvoucher') :
                    echo '<input required min="0" step="0.1" name="txtvalue" type="number" id="voucherValue" class="form-control" />';
                else :
                    echo '<input required min="0" step="0.1" value="' . $result['value'] . '" name="txtvalue" type="number" id="voucherValue" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="voucherValue_err"></span>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherQuantity">Quantity</label>
                <?php
                if ($act == 'addvoucher') :
                    echo '<input required min="0" name="txtquantity" type="number" id="voucherQuantity" class="form-control" />';
                else :
                    echo '<input required min="0" value="' . $result['quantity'] . '" name="txtquantity" type="number" id="voucherQuantity" class="form-control" />';
                endif;
                ?>
                <span class="form-error" id="voucherQuantity_err"></span>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="form-label" for="voucherstart">Voucher Start</label>
                        <?php
                        if ($act == 'addvoucher') :
                            echo '<input required name="txtstart" type="datetime-local" id="voucherstart" class="form-control" />';
                        else :
                            echo '<input required value="' . $result['voucher_start'] . '" name="txtstart" type="datetime-local" id="voucherStart" class="form-control" />';
                        endif;
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="voucherend">Voucher End</label>
                        <?php
                        if ($act == 'addvoucher') :
                            echo '<input required name="txtend" type="datetime-local" id="voucherend" class="form-control" />';
                        else :
                            echo '<input required value="' . $result['voucher_end'] . '" name="txtend" type="datetime-local" id="voucherend" class="form-control" />';
                        endif;
                        ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherIncludeCategory">Include Categorys</label>
                <select class="form-select" name="txtincludecategory[]" size="4" multiple aria-label="Default select example">
                    <?php
                    $selected = explode(':', $result['include_category']);
                    $allInCategory = false;
                    if (in_array("All", $selected)) {
                        echo '<option value="All" selected>All Categorys (Choose this if u want to choose all options)</option>';
                        $allInCategory = true;
                    } else
                        echo '<option value="All">All Categorys (Choose this if u want to choose all options)</option>';
                    ?>
                    <?php
                    $category = new Category();
                    $categorys = $category->selectAll();
                    if ($act == 'addvoucher') :
                        while ($setCategory = $categorys->fetch()) :
                    ?>
                            <option value="<?php echo $setCategory['id']; ?>">Id: <?php echo $setCategory['id']; ?>. <?php echo $setCategory['name']; ?></option>
                            <?php
                        endwhile;
                    else :
                        while ($setCategory = $categorys->fetch()) :
                            if (in_array($setCategory['id'], $selected) && !$allInCategory) :
                            ?>
                                <option value="<?php echo $setCategory['id']; ?>" selected>Id: <?php echo $setCategory['id']; ?>. <?php echo $setCategory['name']; ?></option>
                            <?php
                            else :
                            ?>
                                <option value="<?php echo $setCategory['id']; ?>">Id: <?php echo $setCategory['id']; ?>. <?php echo $setCategory['name']; ?></option>
                            <?php

                            endif;
                            ?>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherexcludeCategory">Exclude Categorys (Prioritized)</label>
                <select class="form-select" name="txtexcludecategory[]" size="4" multiple aria-label="Default select example">
                    <?php
                    $selected = explode(':', $result['exclude_category']);
                    $allExCategory = false;
                    if (in_array("All", $selected)) {
                        echo '<option value="All" selected>All Categorys (Choose this if u want to choose all options)</option>';
                        $allExCategory = true;
                    } else
                        echo '<option value="All">All Categorys (Choose this if u want to choose all options)</option>';
                    ?>
                    <?php
                    $category = new Category();
                    $categorys = $category->selectAll();
                    if ($act == 'addvoucher') :
                        while ($setCategory = $categorys->fetch()) :
                    ?>
                            <option value="<?php echo $setCategory['id']; ?>">Id: <?php echo $setCategory['id']; ?>. <?php echo $setCategory['name']; ?></option>
                            <?php
                        endwhile;
                    else :
                        $selected = explode(':', $result['exclude_category']);
                        while ($setCategory = $categorys->fetch()) :
                            if (in_array($setCategory['id'], $selected) && !$allExCategory) :
                            ?>
                                <option value="<?php echo $setCategory['id']; ?>" selected>Id: <?php echo $setCategory['id']; ?>. <?php echo $setCategory['name']; ?></option>
                            <?php

                            else :
                            ?>
                                <option value="<?php echo $setCategory['id']; ?>">Id: <?php echo $setCategory['id']; ?>. <?php echo $setCategory['name']; ?></option>
                            <?php

                            endif;
                            ?>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherIncludeproduct">Include products</label>
                <select class="form-select" name="txtincludeproduct[]" size="4" multiple aria-label="Default select example">
                    <?php
                    $selected = explode(':', $result['include_product']);
                    $allInProduct = false;
                    if (in_array("All", $selected)) {
                        echo '<option value="All" selected>All Products (Choose this if u want to choose all options)</option>';
                        $allInProduct = true;
                    } else
                        echo '<option value="All">All Products (Choose this if u want to choose all options)</option>';
                    ?>
                    <?php
                    $product = new product();
                    $products = $product->selectAll();
                    if ($act == 'addvoucher') :
                        while ($setproduct = $products->fetch()) :
                    ?>
                            <option value="<?php echo $setproduct['id']; ?>">Id: <?php echo $setproduct['id']; ?>. <?php echo $setproduct['name']; ?></option>
                            <?php
                        endwhile;
                    else :
                        $selected = explode(':', $result['include_product']);
                        while ($setproduct = $products->fetch()) :
                            if (in_array($setproduct['id'], $selected) && !$allInProduct) :
                            ?>
                                <option value="<?php echo $setproduct['id']; ?>" selected>Id: <?php echo $setproduct['id']; ?>. <?php echo $setproduct['name']; ?></option>
                            <?php

                            else :
                            ?>
                                <option value="<?php echo $setproduct['id']; ?>">Id: <?php echo $setproduct['id']; ?>. <?php echo $setproduct['name']; ?></option>
                            <?php

                            endif;
                            ?>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherexcludeproduct">Exclude products (Prioritized)</label>
                <select class="form-select" name="txtexcludeproduct[]" size="4" multiple aria-label="Default select example">
                    <?php
                    $selected = explode(':', $result['exclude_product']);
                    $allExProduct = false;
                    if (in_array("All", $selected)) {
                        echo '<option value="All" selected>All Products (Choose this if u want to choose all options)</option>';
                        $allExProduct = true;
                    } else
                        echo '<option value="All">All Products (Choose this if u want to choose all options)</option>';
                    ?>
                    <?php
                    $product = new product();
                    $products = $product->selectAll();
                    if ($act == 'addvoucher') :
                        while ($setproduct = $products->fetch()) :
                    ?>
                            <option value="<?php echo $setproduct['id']; ?>">Id: <?php echo $setproduct['id']; ?>. <?php echo $setproduct['name']; ?></option>
                            <?php
                        endwhile;
                    else :
                        $selected = explode(':', $result['exclude_product']);
                        while ($setproduct = $products->fetch()) :
                            if (in_array($setproduct['id'], $selected) && !$allExCategory) :
                            ?>
                                <option value="<?php echo $setproduct['id']; ?>" selected>Id: <?php echo $setproduct['id']; ?>. <?php echo $setproduct['name']; ?></option>
                            <?php

                            else :
                            ?>
                                <option value="<?php echo $setproduct['id']; ?>">Id: <?php echo $setproduct['id']; ?>. <?php echo $setproduct['name']; ?></option>
                            <?php

                            endif;
                            ?>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherIncludecustomer">Include customers</label>
                <select class="form-select" name="txtincludecustomer[]" size="4" multiple aria-label="Default select example">
                    <?php
                    $selected = explode(':', $result['include_customer']);
                    $allInCustomer = false;
                    if (in_array("All", $selected)) {
                        echo '<option value="All" selected>All Customers (Choose this if u want to choose all options)</option>';
                        $allInCustomer = true;
                    } else
                        echo '<option value="All">All Customers (Choose this if u want to choose all options)</option>';
                    ?>
                    <?php
                    $customer = new customer();
                    $customers = $customer->selectAll();
                    if ($act == 'addvoucher') :
                        while ($setcustomer = $customers->fetch()) :
                    ?>
                            <option value="<?php echo $setcustomer['customer_id']; ?>">Id: <?php echo $setcustomer['customer_id']; ?>. <?php echo $setcustomer['name']; ?></option>
                            <?php
                        endwhile;
                    else :
                        $selected = explode(':', $result['include_customer']);
                        while ($setcustomer = $customers->fetch()) :
                            if (in_array($setcustomer['customer_id'], $selected) && !$allInCustomer) :
                            ?>
                                <option value="<?php echo $setcustomer['customer_id']; ?>" selected>Id: <?php echo $setcustomer['customer_id']; ?>.<?php echo $setcustomer['name']; ?></option>
                            <?php

                            else :
                            ?>
                                <option value="<?php echo $setcustomer['customer_id']; ?>">Id: <?php echo $setcustomer['customer_id']; ?>.<?php echo $setcustomer['name']; ?></option>
                            <?php

                            endif;
                            ?>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="voucherexcludecustomer">Exclude customers (Prioritized)</label>
                <select class="form-select" name="txtexcludecustomer[]" size="4" multiple aria-label="Default select example">
                    <?php
                    $selected = explode(':', $result['exclude_customer']);
                    $allExCustomer = false;
                    if (in_array("All", $selected)) {
                        echo '<option value="All" selected>All Customers (Choose this if u want to choose all options)</option>';
                        $allExCustomer = true;
                    } else
                        echo '<option value="All">All Customers (Choose this if u want to choose all options)</option>';
                    ?>
                    <?php
                    $customer = new customer();
                    $customers = $customer->selectAll();
                    if ($act == 'addvoucher') :
                        while ($setcustomer = $customers->fetch()) :
                    ?>
                            <option value="<?php echo $setcustomer['customer_id']; ?>">Id: <?php echo $setcustomer['customer_id']; ?>.<?php echo $setcustomer['name']; ?></option>
                            <?php
                        endwhile;
                    else :
                        $selected = explode(':', $result['exclude_customer']);
                        while ($setcustomer = $customers->fetch()) :
                            if (in_array($setcustomer['customer_id'], $selected) && !$allExCustomer) :
                            ?>
                                <option value="<?php echo $setcustomer['customer_id']; ?>" selected>Id: <?php echo $setcustomer['customer_id']; ?>.<?php echo $setcustomer['name']; ?></option>
                            <?php

                            else :
                            ?>
                                <option value="<?php echo $setcustomer['customer_id']; ?>">Id: <?php echo $setcustomer['customer_id']; ?>.<?php echo $setcustomer['name']; ?></option>
                            <?php

                            endif;
                            ?>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>
        </div>

        <div class="form-button">
            <a href="/Admin/index.php?action=dashboard&act=vouchers" class="btn btn-danger ml-3 mt-3" style="float: right;"><b>Close</b></a>
        <?php
        switch ($act) {
            case 'addvoucher':
                echo '<button class="btn btn-success m-3" style="float: right;" type="button" id="addsubmitbtn"><b>Add Voucher</b></button>';
            break;
            case 'editvoucher':
                echo '<button class="btn btn-warning m-3" style="float: right;" type="button" id="editsubmitbtn"><b>Edit Voucher</b></button>';
            break;
        }
    endif;
        ?>
        </div>
        </form>
</div>
<script>
    $(document).ready(function() {
        $('#voucherName').on('input', function() {
            checkVoucherName();
        });
        $('#voucherCode').on('input', function() {
            checkVoucherCode();
        });
        $('#voucherValue').on('input', function() {
            checkVoucherValue();
        });
        $('#voucherQuantity').on('input', function() {
            checkVoucherQuantity();
        });

        $('#addsubmitbtn').click(function() {
            if (!checkVoucherName() && !checkVoucherCode() && !checkVoucherValue() && !checkVoucherQuantity()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else if (!checkVoucherName() || !checkVoucherCode() || !checkVoucherValue() || !checkVoucherQuantity()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else {
                $("#message").html("");
                var form = $('#addvoucherform')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "/Admin/index.php?action=dashboard&act=addvoucher_action",
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
                            $('#addvoucherform').trigger("reset");
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
            if (!checkVoucherName() && !checkVoucherCode() && !checkVoucherValue() && !checkVoucherQuantity()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else if (!checkVoucherName() || !checkVoucherCode() || !checkVoucherValue() || !checkVoucherQuantity()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else {
                $("#message").html("");
                var form = $('#editvoucherform')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "/Admin/index.php?action=dashboard&act=editvoucher_action",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    beforeSend: function() {
                        $('#editsubmitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                        $('#editsubmitbtn').attr("disabled", true);
                        $('#editsubmitbtn').css({
                            "border-radius": "50%"
                        });
                    },

                    success: function(data) {
                        $('#message').html(data);
                    },
                    complete: function() {
                        setTimeout(function() {
                            $('#addvoucherform').trigger("reset");
                            $('#editsubmitbtn').html('Submit');
                            $('#editsubmitbtn').attr("disabled", false);
                            $('#editsubmitbtn').css({
                                "border-radius": "4px"
                            });
                        }, 50000);
                    }
                });
            }
        });
    });

    function checkVoucherName() {
        if ($('#voucherName').val() == "") {
            $('#voucherName_err').html('Tên không được để trống');
            return false;
        } else {
            $('#voucherName_err').html('');
            return true;
        }
    }
    function checkVoucherCode() {
        var pattern = /^[A-Z0-9]+$/;
        var code = $('#voucherCode').val();
        var validcode = pattern.test(code);
        if ($('#voucherCode').val() == "") {
            $('#voucherCode_err').html('Code không được để trống');
            return false;
        } else if ($('#voucherCode').val().length < 4) {
            $('#voucherCode_err').html('Code phải có từ 4 kí tự trở lên');
            return false;
        } else if (!validcode) {
            $('#voucherCode_err').html('Code chỉ có ký tự từ A-Z và chữ số ');
            return false;
        } else {
            $('#voucherCode_err').html('');
            return true;
        }
    }

    function checkVoucherValue() {
        var pattern3 = /^[0-9. ]+$/;
        var quantity = $('#voucherValue').val();
        if (quantity == "") {
            $('#voucherValue_err').html('Giá trị voucher không được để trống');
            return false;
        } else if (quantity < 0) {
            $('#voucherValue_err').html('Giá trị voucher có giá trị lớn hơn 0');
            return false;
        } else {
            $('#voucherValue_err').html('');
            return true;
        }
    }

    function checkVoucherQuantity() {
        var pattern3 = /^[0-9. ]+$/;
        var quantity = $('#voucherQuantity').val();
        if (quantity == "") {
            $('#voucherQuantity_err').html('Số lượng không được để trống');
            return false;
        } else if (quantity < 0) {
            $('#voucherQuantity_err').html('Số lượng có giá trị lớn hơn 0');
            return false;
        } else {
            $('#voucherQuantity_err').html('');
            return true;
        }
    }
</script>