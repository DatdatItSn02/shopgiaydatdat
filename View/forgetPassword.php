<section class="vh-100" style="background-color: #ffffff;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Forget Password</p>
                <div id="message"></div>
                <div id="hidden" style="display: none;"></div>
                <div id="data">
                    <form id="myloginform" class="mx-1 mx-md-4" method="post">

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="loginemail">Your email</label>
                        <input type="email" name="txtemail" id="loginemail" class="form-control" />
                        <span class="error" id="loginemail_err"></span>
                        </div>
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
    $('#loginemail').on('input', function() {
      checkemail();
    });
    $('#verifycode').on('input', function() {
      checkverifycode();
    });
    
    $('#loginsubmitbtn').click(function() {
      if (!checkemail()) {
        $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
      } else if (!checkemail()) {
        $("#message").html(`<div class="alert alert-warning">Bạn chưa điền đầy đủ thông tin</div>`);
      } else {
        $("#message").html("");
        var form = $('#myloginform')[0];
        var data = new FormData(form);
        $.ajax({
          type: "POST",
          url: "index.php?action=forgetpassword&act=forgetpassword_action",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          async: false,
          beforeSend: function() {
            $('#loginsubmitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
            $('#loginsubmitbtn').attr("disabled", true);
            $('#loginsubmitbtn').css({
              "border-radius": "50%"
            });
          },

          success: function(data) {
            $('#hidden').html(data);
            // let email = $('#loginemail').val();
            // $('#message').html(`<div class="alert alert-warning">Mã xác thực đã được gửi qua email: <span style="color:#1cc88a;">${email}</span></div>`);
          },
          complete: function() {
            setTimeout(function() {
              $('#myloginform').trigger("reset");
              $('#loginsubmitbtn').html('Submit');
              $('#loginsubmitbtn').attr("disabled", false);
              $('#loginsubmitbtn').css({
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
    var email = $('#loginemail').val();
    var validemail = pattern1.test(email);
    if (email == "") {
      $('#loginemail_err').html('Email không được để trống');
      return false;
    } else if (!validemail) {
      $('#loginemail_err').html('Email không hợp lệ');
      return false;
    } else {
      $('#loginemail_err').html('');
      return true;
    }
  }
  
  function checkverifycode() {
        if (!$.isNumeric($("#verifycode").val())) {
            $("#verifycode_err").html("Chỉ được nhập số");
            return false;
        } else if ($("#verifycode").val().length != 6) {
            $("#verifycode_err").html("Mã xác thực có 6 số");
            return false;
        }
        else {
            $("#verifycode_err").html("");
            return true;
        }
    }
</script>