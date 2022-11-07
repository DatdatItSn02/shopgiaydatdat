<div class="container">
<div id="message"></div>
<?php 
    if(isset($_GET['act'])) :
        $act = $_GET['act'];
        switch ($act) {
            case 'addcustomer' :
                echo '<form enctype="multipart/form-data" id="addcustomerform" class="mx-1 mx-md-4">';
            break;
            case 'editcustomer' :
                echo '<form id="editcustomerform" class="mx-1 mx-md-4">';
            break;
        }
        if(isset($_GET['id'])) :
            $id = $_GET['id'];
            $customer = new customer();
            $result = $customer->selectSingle($id);
            echo '<input value='.$result['customer_id'].' name="txtid" type="hidden" id="customerId" class="form-control" />';
            echo '<input value='.$result['image'].' name="txtimage" type="hidden" id="customerimage" class="form-control" />';
            echo '<a href="/Admin/index.php?action=dashboard&act=editcustomerpassword&id='.$result['customer_id'].'" class="btn btn-warning m-3"><b>Đổi mật khẩu</b></a>';
            echo '<a href="/Admin/index.php?action=dashboard&act=editcustomerimage&id='.$result['customer_id'].'" class="btn btn-warning m-3"><b>Đổi hình ảnh</b></a>';
        endif;
?>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="customerEmail">Email</label>
            <?php
                if($act == 'addcustomer') :
                    echo '<input required name="txtemail" type="email" id="customerEmail" class="form-control" />';
                else:
                    echo '<input required value="'.$result['email'].'" name="txtemail" type="email" id="customerEmail" class="form-control" />';
                endif;
            ?>
            <span class="form-error" id="customerEmail_err"></span>
        </div>
    </div>

    <?php 
        if($act == 'addcustomer') : 
    ?>
        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="customerPassword">Password</label>
                <input required name="txtpassword" type="password" id="customerPassword" class="form-control" />
            </div>
        </div>
        <span class="form-error" id="customerPassword_err"></span>
    <?php
        endif;
    ?>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="customerName">Name</label>
            <?php
                if($act == 'addcustomer') :
                    echo '<input required maxlength="50" name="txtname" type="text" id="customerName" class="form-control" />';
                else:
                    echo '<input required maxlength="50" value="'.$result['name'].'" name="txtname" type="text" id="customerName" class="form-control" />';
                endif;
            ?>
                <span class="form-error" id="customerName_err"></span>
        </div>
    </div>
    
    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="txtsex">Sex :</label>
            <select class="form-select" name="txtsex" aria-label="Default select example">
            <?php
                if($act == 'editcustomer') :
                    if($result['sex'] == "male") :
                        echo '<option value="female">Female</option>
                            <option value="male" selected="selected">Male</option>';
                    else:
                        echo '<option value="female" selected="selected">Female</option>
                            <option value="male">Male</option>';
                    endif;
                else:
            ?>    
                <option value="female">Female</option>
                <option value="male">Male</option>
            <?php 
                endif;
            ?>
            </select>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="customerbirthday">Birthday</label>
            <?php
                if($act == 'addcustomer') :
                    echo '<input required name="txtbirthday" type="date" id="customerbirthday" class="form-control" />';
                else:
                    echo '<input required value="'.$result['birthday'].'" name="txtbirthday" type="date" id="customerAddress" class="form-control" />';
                endif;
            ?>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="customerAddress">Address</label>
            <?php
                if($act == 'addcustomer') :
                    echo '<input required name="txtaddress" type="text" id="customerAddress" class="form-control" />';
                else:
                    echo '<input required value="'.$result['address'].'" name="txtaddress" type="text" id="customerAddress" class="form-control" />';
                endif;
            ?>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="customerPhone">Phone</label>
            <?php
                if($act == 'addcustomer') :
                    echo '<input required name="txtphone" type="number" id="customerPhone" class="form-control" />';
                else:
                    echo '<input required value="'.$result['phone'].'" name="txtphone" type="number" id="customerPhone" class="form-control" />';
                endif;
            ?>
            <span class="form-error" id="customerPhone_err"></span>
        </div>
    </div>
    
    <?php 
        if($act =='addcustomer') :
        ?>
        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="customerImage">Image</label>
                <input required name="txtimage" type="file" id="customerImage" class="form-control" />
            </div>
        </div>
    <?php
        endif;
    ?>

    <div class="form-button">
        <a href="/Admin/index.php?action=dashboard&act=customers" class="btn btn-danger ml-3 mt-3" style="float: right;" ><b>Close</b></a>
    <?php 
            switch ($act) {
                case 'addcustomer' :
                    echo '<button id="addsubmitbtn" class="btn btn-success m-3" style="float: right;" type="button"><b>Thêm tài khoản</b></button>';
                break;
                case 'editcustomer' :
                    echo '<button id="editsubmitbtn" class="btn btn-warning m-3" style="float: right;" type="button"><b>Sửa tài khoản</b></button>';
                break;
            }
        endif;
    ?>
    </div>
</form>
</div>
<script>
    $(document).ready(function () {
    $('#customerName').on('input', function () {
        checkname();
    });
    $('#customerEmail').on('input', function () {
        checkemail();
    });
    $('#customerPhone').on('input', function () {
        checkphone();
    });
    $('#customerPassword').on('input', function () {
        checkpass();
    });

    $('#addsubmitbtn').click(function () {
        if (!checkname() && !checkemail() && !checkphone() && !checkpass()) {
            $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
        } else if (!checkname() || !checkemail() || !checkphone() || !checkpass()) {
            $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
        }
        else {
            $("#message").html("");
            var form = $('#addcustomerform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "/Admin/index.php?action=dashboard&act=addcustomer_action",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function () {
                    $('#addsubmitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#addsubmitbtn').attr("disabled", true);
                    $('#addsubmitbtn').css({ "border-radius": "50%" });
                },

                success: function (data) {
                    $('#message').html(data);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#myform').trigger("reset");
                        $('#addsubmitbtn').html('Submit');
                        $('#addsubmitbtn').attr("disabled", false);
                        $('#addsubmitbtn').css({ "border-radius": "4px" });
                    }, 50000);
                }
            });
        }
    }); 
    $('#editsubmitbtn').click(function () {
        if (!checkname() && !checkemail() && !checkphone()) {
            $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
        } else if (!checkname() || !checkemail() || !checkphone()) {
            $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
        }
        else {
            $("#message").html("");
            var form = $('#editcustomerform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "/Admin/index.php?action=dashboard&act=editcustomer_action",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function () {
                    $('#editsubmitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#editsubmitbtn').attr("disabled", true);
                    $('#editsubmitbtn').css({ "border-radius": "50%" });
                },

                success: function (data) {
                    $('#message').html(data);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#myform').trigger("reset");
                        $('#editsubmitbtn').html('Submit');
                        $('#editsubmitbtn').attr("disabled", false);
                        $('#editsubmitbtn').css({ "border-radius": "4px" });
                    }, 50000);
                }
            });
        }
    });
    });
    function checkname() {
    var pattern = /^[A-Za-z ]+$/;
    var user = $('#customerName').val();
    var validuser = pattern.test(user);
        if ($('#customerName').val() == ""){
            $('#customerName_err').html('Tên không được để trống');
            return false;
        }else if ($('#customerName').val().length < 4) {
            $('#customerName_err').html('Tên phải có từ 4 kí tự trở lên');
            return false;
        } else if (!validuser) {
            $('#customerName_err').html('Tên chỉ có ký tự từ A-Z hoặc a-z ');
            return false;
        } else {
            $('#customerName_err').html('');
            return true;
        }
    }
    function checkemail() {
        var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var email = $('#customerEmail').val();
        var validemail = pattern1.test(email);
        if (email == "") {
            $('#customerEmail_err').html('Email không được để trống');
            return false;
        } else if (!validemail) {
            $('#customerEmail_err').html('Email không hợp lệ');
            return false;
        } else {
            $('#customerEmail_err').html('');
            return true;
        }
    }
    function checkpass() {
        var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        var pass = $('#customerPassword').val();
        var validpass = pattern2.test(pass);

        if (pass == "") {
            $('#customerPassword_err').html('Mật khẩu không được để trống');
            return false;
        } else if (!validpass) {
            $('#customerPassword_err').html('Mật khẩu bao gồm ít nhất 8 ký tự, 1 ký tự hoa, 1 ký tự thường, 1 ký tự đặc biệt và 1 ký tự số');
            return false;

        } else {
            $('#customerPassword_err').html("");
            return true;
        }
    }

    function checkphone() {
        if (!$.isNumeric($("#customerPhone").val())) {
            $("#customerPhone_err").html("Chỉ được nhập số");
            return false;
        } else if ($("#customerPhone").val().length != 10) {
            $("#customerPhone_err").html("Bắt buộc 10 số");
            return false;
        }
        else {
            $("#customerPhone_err").html("");
            return true;
        }
    }

</script>