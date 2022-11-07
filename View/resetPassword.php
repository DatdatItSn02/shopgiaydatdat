<section class="vh-100" style="background-color: #ffffff;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Change Password</p>
                                <div id="message"></div>
                                <div id="data">
                                    <form id="myloginform" class="mx-1 mx-md-4" method="post">
                                        <?php
                                            if(isset($_POST['txtemail']))
                                            {
                                                $email = $_POST['txtemail'];
                                                $customer = new Customer();
                                                $customerId = $customer->selectCustomerByEmail($email)['customer_id'];
                                                echo '<input type="hidden" name="txtid" value="'.$customerId.'" />';
                                            }
                                        ?>
                                        <div id="hidden">
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-0">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="newpassword">New Password</label>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline input-group flex-fill mb-0">
                                                <input name="txtnewpassword" type="password" id="newpassword" class="form-control" />
                                                <span class="btn" onclick="password_show_hide();">
                                                    <i class="fas fa-eye" id="show_eye"></i>
                                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2 mt-2">
                                            <i class="fa-lg me-3 fa-fw"></i>
                                            <span class="error" id="newpassword_err"></span>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-0">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="renewpassword">Retype New Password</label>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline input-group flex-fill mb-0">
                                                <input name="txtrenewpassword" type="password" id="renewpassword" class="form-control" />
                                                <span class="btn" onclick="repassword_show_hide();">
                                                    <i class="fas fa-eye" id="reshow_eye"></i>
                                                    <i class="fas fa-eye-slash d-none" id="rehide_eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2 mt-2">
                                            <i class="fa-lg me-3 fa-fw"></i>
                                            <span class="error" id="renewpassword_err"></span>
                                        </div>
                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="button" id="loginsubmitbtn" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Submit</button>
                                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="index.php?action=register" class="link-danger">Register</a></p>
                                        </div>

                                    </form>
                                </div>
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
    $(document).ready(function() {
        $('#newpassword').on('input', function() {
            checkpass();
        });
        $('#renewpassword').on('input', function() {
            checkrepass();
        });

        $('#loginsubmitbtn').click(function() {
            if (!checkpass() && !checkrepass()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else if (!checkpass() || !checkrepass()) {
                $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
            } else {
                $("#message").html("");
                var form = $('#myloginform')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "index.php?action=forgetpassword&act=resetpassword_action",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    //   beforeSend: function() {
                    //     $('#loginsubmitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    //     $('#loginsubmitbtn').attr("disabled", true);
                    //     $('#loginsubmitbtn').css({
                    //       "border-radius": "50%"
                    //     });
                    //   },

                    success: function(data) {
                      $("#hidden").html(data);   
                    },
                    //   complete: function() {
                    //     setTimeout(function() {
                    //       $('#myloginform').trigger("reset");
                    //       $('#loginsubmitbtn').html('Submit');
                    //       $('#loginsubmitbtn').attr("disabled", false);
                    //       $('#loginsubmitbtn').css({
                    //         "border-radius": "4px"
                    //       });
                    //     }, 50000);
                    //   }
                });
            }
        });
    });

    function checkpass() {
        var pass = $('#newpassword').val();
        if (pass == "") {
            $('#newpassword_err').html('Mật khẩu không được để trống');
            return false;
        } else {
            $('#newpassword_err').html("");
            return true;
        }
    }

    function checkrepass() {
        var pass = $('#newpassword').val();
        var repass = $('#renewpassword').val();
        if (repass == "") {
            $('#renewpassword_err').html('Nhập lại mật khẩu không được để trống');
            return false;
        }
        else if(repass != pass)
        {
            $('#renewpassword_err').html('Nhập lại mật khẩu không giống!');
        } 
        else {
            $('#renewpassword_err').html("");
            return true;
        }
    }


    function password_show_hide() {
        var x = document.getElementById("newpassword");
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
    function repassword_show_hide() {
        var x = document.getElementById("renewpassword");
        var show_eye = document.getElementById("reshow_eye");
        var hide_eye = document.getElementById("rehide_eye");
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