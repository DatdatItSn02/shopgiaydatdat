<section class="vh-100" style="background-color: #ffffff;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                <div id="hidden" style="display:none;"></div>
                                <form id="myform" method="post" class="mx-1 mx-md-4">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="email">Email</label>
                                            <input name="txtemail" type="email"  id="email" class="form-control" />
                                            <span class="error" id="email_err"></span> 
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <label class="form-label" for="password">Password</label>
                                        
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


                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="name">Your Name</label>
                                            <input name="txtname" maxlength="50" type="text" id="name" class="form-control" />
                                            <span class="error" id="name_err"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="address">Your Adress</label>
                                            <input name="txtaddress" type="text" id="address" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="phone">Phone</label>
                                            <input name="txtphone" type="text" id="phone" class="form-control" />
                                            <span class="error" id="phone_err"></span>
                                        </div>
                                    </div>

                                    <div class="text-center text-lg-start mt-4 pt-2">
                                        <button type="button" id="submitbtn" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                        <p class="small fw-bold mt-2 pt-1 mb-0">You already have an account? <a href="/index.php?action=login" class="link-danger">Login</a></p>
                                    </div>

                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function () {
    $('#name').on('input', function () {
        checkname();
    });
    $('#email').on('input', function () {
        checkemail();
    });
    $('#phone').on('input', function () {
        checkphone();
    });
    $('#password').on('input', function () {
        checkpass();
    });

    $('#submitbtn').click(function () {
        if (!checkname() && !checkemail() && !checkphone() && !checkpass()) {
            $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
        } else if (!checkname() || !checkemail() || !checkphone() || !checkpass()) {
            $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
        }
        else {
            console.log("ok");
            $("#message").html("");
            var form = $('#myform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "index.php?action=register&act=register_action",
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
                    $('#hidden').html(data);
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
function checkname() {
var pattern = /^[A-Za-z ]+$/;
var user = $('#name').val();
var validuser = pattern.test(user);
    if ($('#name').val() == ""){
        $('#name_err').html('Tên không được để trống');
        return false;
    }else if ($('#name').val().length < 4) {
        $('#name_err').html('Tên phải có từ 4 kí tự trở lên');
        return false;
    } else if (!validuser) {
        $('#name_err').html('Tên chỉ có ký tự từ A-Z hoặc a-z ');
        return false;
    } else {
        $('#name_err').html('');
        return true;
    }
}
function checkemail() {
    var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $('#email').val();
    var validemail = pattern1.test(email);
    if (email == "") {
        $('#email_err').html('Email không được để trống');
        return false;
    } else if (!validemail) {
        $('#email_err').html('Email không hợp lệ');
        return false;
    } else {
        $('#email_err').html('');
        return true;
    }
}
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
// function checkcpass() {
//     var pass = $('#password').val();
//     var cpass = $('#cpassword').val();
//     if (cpass == "") {
//         $('#cpassword_err').html('confirm password cannot be empty');
//         return false;
//     } else if (pass !== cpass) {
//         $('#cpassword_err').html('confirm password did not match');
//         return false;
//     } else {
//         $('#cpassword_err').html('');
//         return true;
//     }
// }

function checkphone() {
    if (!$.isNumeric($("#phone").val())) {
        $("#phone_err").html("Chỉ được nhập số");
        return false;
    } else if ($("#phone").val().length != 10) {
        $("#phone_err").html("Bắt buộc 10 số");
        return false;
    }
    else {
        $("#phone_err").html("");
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