<section class="vh-100" style="background-color: #ffffff;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign in as staff</p>
                <div id="message" style="display:none;"></div>
                <form class="mx-1 mx-md-4" id="mystaffloginform" method="post">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="staffloginemail">Your email</label>
                      <input type="email" name="txtusername" id="staffloginemail" class="form-control" />
                      <span class="error" id="staffloginemail_err"></span>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-0">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <label class="form-label" for="password">Password</label>

                  </div>
                  <div class="d-flex flex-row align-items-center">
                    <i class="fa-lg me-3 fa-fw"></i>
                    <div class="form-outline input-group flex-fill mb-0">
                      <input name="txtpassword" type="password" id="staffloginpassword" class="form-control" />
                      <span class="btn" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                      </span>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-2 mt-2">
                    <i class="fa-lg me-3 fa-fw"></i>
                    <span class="error" id="staffloginpassword_err"></span>
                  </div>


                  <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                      <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" disabled />
                      <label class="form-check-label" for="form2Example3">
                        Remember me
                      </label>
                    </div>
                    <a href="#!" class="text-body">Forgot password?</a>
                  </div>

                  <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="button" id="staffloginsubmitbtn" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
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
  $(document).ready(function() {
    $('#staffloginemail').on('input', function() {
      checkemail();
    });
    $('#staffloginpassword').on('input', function() {
      checkpass();
    });

    $('#staffloginsubmitbtn').click(function() {
      if (!checkemail() && !checkpass()) {
        $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
      } else if (!checkemail() || !checkpass()) {
        $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
      } else {
        $("#message").html("");
        var form = $('#mystaffloginform')[0];
        var data = new FormData(form);
        $.ajax({
          type: "POST",
          url: "index.php?action=staffLogin&act=staffLogin_action",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          async: false,
          beforeSend: function() {
            $('#staffloginsubmitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
            $('#staffloginsubmitbtn').attr("disabled", true);
          },

          success: function(data) {
            $('#message').html(data);
          },
          complete: function() {
            setTimeout(function() {
              $('#mystaffloginform').trigger("reset");
              $('#staffloginsubmitbtn').html('Submit');
              $('#staffloginsubmitbtn').attr("disabled", false);
              $('#staffloginsubmitbtn').css({
                "border-radius": "4px"
              });
            }, 50000);
          }
        });
      }
    });
  });

  function checkemail() {
    var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $('#staffloginemail').val();
    var validemail = pattern1.test(email);
    if (email == "") {
      $('#staffloginemail_err').html('Email không được để trống');
      return false;
    } else if (!validemail) {
      $('#staffloginemail_err').html('Email không hợp lệ');
      return false;
    } else {
      $('#staffloginemail_err').html('');
      return true;
    }
  }

  function checkpass() {
    var pass = $('#staffloginpassword').val();
    if (pass == "") {
      $('#staffloginpassword_err').html('Mật khẩu không được để trống');
      return false;
    } else {
      $('#staffloginpassword_err').html("");
      return true;
    }
  }

  function password_show_hide() {
    var x = document.getElementById("staffloginpassword");
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