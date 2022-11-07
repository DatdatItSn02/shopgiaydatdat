<div class="container">
<div id="message"></div>
<?php 
    if(isset($_GET['act'])) :
        $act = $_GET['act'];
        switch ($act) {
            case 'addstaff' :
                echo '<form enctype="multipart/form-data" id="addstaffform" class="mx-1 mx-md-4">';
            break;
            case 'editstaff' :
                echo '<form id="editstaffform" class="mx-1 mx-md-4">';
            break;
        }
        if(isset($_GET['id'])) :
            $id = $_GET['id'];
            $staff = new Staff();
            $result = $staff->selectSingle($id);
            echo '<input value='.$result['staff_id'].' name="txtid" type="hidden" id="staffId" class="form-control" />';
            echo '<input value='.$result['image'].' name="txtimage" type="hidden" id="staffimage" class="form-control" />';
            echo '<a href="/Admin/index.php?action=dashboard&act=editstaffpassword&id='.$result['staff_id'].'" class="btn btn-warning m-3"><b>Đổi mật khẩu</b></a>';
            echo '<a href="/Admin/index.php?action=dashboard&act=editstaffimage&id='.$result['staff_id'].'" class="btn btn-warning m-3"><b>Đổi hình ảnh</b></a>';
        endif;
?>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="staffEmail">Email</label>
            <?php
                if($act == 'addstaff') :
                    echo '<input required name="txtemail" type="email" id="staffEmail" class="form-control" />';
                else:
                    echo '<input required value="'.$result['email'].'" name="txtemail" type="email" id="staffEmail" class="form-control" />';
                endif;
            ?>
            <span class="form-error" id="staffEmail_err"></span>
        </div>
    </div>

    <?php 
        if($act == 'addstaff') : 
    ?>
        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="staffPassword">Password</label>
                <input required name="txtpassword" type="password" id="staffPassword" class="form-control" />
                <span class="form-error" id="staffPassword_err"></span>
            </div>
        </div>
        
    <?php
        endif;
    ?>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="staffName">Name</label>
            <?php
                if($act == 'addstaff') :
                    echo '<input required maxlength="50" name="txtname" type="text" id="staffName" class="form-control" />';
                else:
                    echo '<input required maxlength="50" value="'.$result['name'].'" name="txtname" type="text" id="staffName" class="form-control" />';
                endif;
            ?>
            <span class="form-error" id="staffName_err"></span>
        </div>
    </div>
    
    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="txtsex">Sex :</label>
            <select class="form-select" name="txtsex" aria-label="Default select example">
            <?php
                if($act == 'editstaff') :
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
            <label class="form-label" for="staffbirthday">Birthday</label>
            <?php
                if($act == 'addstaff') :
                    echo '<input required name="txtbirthday" type="date" id="staffbirthday" class="form-control" />';
                else:
                    echo '<input required value="'.$result['birthday'].'" name="txtbirthday" type="date" id="staffAddress" class="form-control" />';
                endif;
            ?>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="staffAddress">Address</label>
            <?php
                if($act == 'addstaff') :
                    echo '<input required name="txtaddress" type="text" id="staffAddress" class="form-control" />';
                else:
                    echo '<input required value="'.$result['address'].'" name="txtaddress" type="text" id="staffAddress" class="form-control" />';
                endif;
            ?>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="staffPhone">Phone</label>
            <?php
                if($act == 'addstaff') :
                    echo '<input required name="txtphone" type="text" id="staffPhone" class="form-control" />';
                else:
                    echo '<input required value="'.$result['phone'].'" name="txtphone" type="number" id="staffPhone" class="form-control" />';
                endif;
            ?>
            <span class="form-error" id="staffPhone_err"></span>
        </div>
    </div>
    
    <div class="d-flex flex-row align-items-center mb-1">
        <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="txtrole">Role :</label>
            <select class="form-select" name="txtrole" aria-label="Default select example">
            <?php
                if($act == 'editstaff') :
                    if($result['role'] == "Member") :
                        echo '<option value="Boss">Boss</option>
                            <option value="Member" selected="selected">Member</option>';
                    else:
                        echo '<option value="Boss" selected="selected">Boss</option>
                            <option value="Member">Member</option>';
                    endif;
                else:
            ?>    
                <option value="Member">Member</option>
                <option value="Boss">Boss</option>
            <?php 
                endif;
            ?>
            </select>
        </div>
    </div>

    <?php 
        if($act =='addstaff') :
        ?>
        <div class="d-flex flex-row align-items-center mb-1">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="staffImage">Image</label>
                <input required name="txtimage" type="file" id="staffImage" class="form-control" />
            </div>
        </div>
    <?php
        endif;
    ?>

    <div class="form-button">
        <a href="/Admin/index.php?action=dashboard&act=staffs" class="btn btn-danger ml-3 mt-3" style="float: right;" ><b>Close</b></a>
    <?php 
            switch ($act) {
                case 'addstaff' :
                    echo '<button class="btn btn-success m-3" style="float: right;" type="button" id="addsubmitbtn"><b>Thêm tài khoản</b></button>';
                break;
                case 'editstaff' :
                    echo '<button class="btn btn-warning m-3" style="float: right;" type="button" id="editsubmitbtn"><b>Sửa tài khoản</b></button>';
                break;
            }
        endif;
    ?>
    </div>
</form>
</div>
<script>
    $(document).ready(function () {
    $('#staffName').on('input', function () {
        checkname();
    });
    $('#staffEmail').on('input', function () {
        checkemail();
    });
    $('#staffPhone').on('input', function () {
        checkphone();
    });
    $('#staffPassword').on('input', function () {
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
            var form = $('#addstaffform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "/Admin/index.php?action=dashboard&act=addstaff_action",
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
            var form = $('#editstaffform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "/Admin/index.php?action=dashboard&act=editstaff_action",
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
    var user = $('#staffName').val();
    var validuser = pattern.test(user);
        if ($('#staffName').val() == ""){
            $('#staffName_err').html('Tên không được để trống');
            return false;
        }else {
            $('#staffName_err').html('');
            return true;
        }
    }
    function checkemail() {
        var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var email = $('#staffEmail').val();
        var validemail = pattern1.test(email);
        if (email == "") {
            $('#staffEmail_err').html('Email không được để trống');
            return false;
        } else if (!validemail) {
            $('#staffEmail_err').html('Email không hợp lệ');
            return false;
        } else {
            $('#staffEmail_err').html('');
            return true;
        }
    }
    function checkpass() {
        var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        var pass = $('#staffPassword').val();
        var validpass = pattern2.test(pass);

        if (pass == "") {
            $('#staffPassword_err').html('Mật khẩu không được để trống');
            return false;
        } else if (!validpass) {
            $('#staffPassword_err').html('Mật khẩu bao gồm ít nhất 8 ký tự, 1 ký tự hoa, 1 ký tự thường, 1 ký tự đặc biệt và 1 ký tự số');
            return false;

        } else {
            $('#staffPassword_err').html("");
            return true;
        }
    }

    function checkphone() {
        var pattern = /^[0-9. ]+$/;

        if (!$.isNumeric($("#staffPhone").val())) {
            $("#staffPhone_err").html("Chỉ được nhập số");
            return false;
        } else if ($("#staffPhone").val().length >= 9) {
            $("#staffPhone_err").html("Bắt buộc từ 9 số trở lên");
            return false;
        } 
        else if ($("#staffPhone").val().length >= 9) {
            $("#staffPhone_err").html("Bắt buộc từ 9 số trở lên");
            return false;
        }
        else {
            $("#staffPhone_err").html("");
            return true;
        }
    }

</script>