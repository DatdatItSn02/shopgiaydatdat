<?php
    if(isset($_GET['id'])) :
        $id = $_GET['id'];
    endif;
?>
<div class="container">
<div id="message"></div>
    <form id="editcustomerpassword" method="post" class="mx-1 mx-md-4">

        <input value="<?php echo $id ?>" name="txtid" type="hidden" id="customerId" class="form-control" />
        <div class="d-flex flex-row align-items-center mb-0">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <label class="form-label" for="password">New Password</label>

                  </div>
                  <div class="d-flex flex-row align-items-center">
                    <i class="fa-lg me-3 fa-fw"></i>
                    <div class="form-outline input-group flex-fill mb-0">
                      <input name="txtpassword" type="password" id="password" class="form-control" />
                      <span class="btn" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                      </span>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-2 mt-2">
                    <i class="fa-lg me-3 fa-fw"></i>
                    <span class="error" id="password_err"></span>
                  </div>
        <div class="form-button">
            <a href="/Admin/index.php?action=dashboard&act=editcustomer&id=<?php echo $id ?>" class="btn btn-danger ml-3 mt-3" style="float: right;" ><b>Close</b></a>
            <button class="btn btn-warning m-3" style="float: right;" id="submitbtn" type="button"><b>Confirm</b></button>
        </div>
    </form>
</div>
<script>
$(document).ready(function () {
    $('#password').on('input', function () {
        checkpass();
    });

    $('#submitbtn').click(function () {
        if (!checkpass()) {
            $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
        } else if (!checkpass()) {
            $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
        }
        else {
            $("#message").html("");
            var form = $('#editcustomerpassword')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "/Admin/index.php?action=dashboard&act=editcustomerpassword_action",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function () {
                    $('#submitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#submitbtn').attr("disabled", true);
                    $('#submitbtn').css({ "border-radius": "50%" });
                },

                success: function (data) {
                    $('#message').html(data);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#myform').trigger("reset");
                        $('#submitbtn').html('Submit');
                        $('#submitbtn').attr("disabled", false);
                        $('#submitbtn').css({ "border-radius": "4px" });
                    }, 50000);
                }
            });
        }
    });
});
function checkpass() {
    var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    var pass = $('#password').val();
    var validpass = pattern2.test(pass);

    if (pass == "") {
        $('#password_err').html('Mật khẩu không được để trống');
        return false;
    } else if (!validpass) {
        $('#password_err').html('Mật khẩu bao gồm ít nhất 8 ký tự, 1 ký tự hoa, 1 ký tự thường, 1 ký tự đặc biệt và 1 ký tự số');
        return false;

    } else {
        $('#password_err').html("");
        return true;
    }
}

function password_show_hide() {
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}
</script>