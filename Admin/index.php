<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php'); // phần mở rộng
spl_autoload_register();
include "./Model/uploadimage.php";
include "./Model/fnVnStrFilter.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Datdat Giày 2nd - Dashboard</title>
        <!-- Bootstrap, jquery, popperjs -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="../node_modules/tinymce/jquery.tinymce.min.js"></script>
    <script src="../node_modules/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js"></script>
    <script src="../node_modules/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js"></script>
    <link href="../node_modules/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
    <script src="../node_modules/tinymce/tinymce.min.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/jquery.tagsinput.min.css" rel="stylesheet" type="text/css">
    <script src="../assets/js/jquery.tagsinput.js"></script>
    <script src="../assets/js/js-fontawesomekit.js" crossorigin="anonymous"></script>
    <script src="../assets/js/js-fontawesome-all.js"></script>
    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="../assets/js/js-fontawesome-all.js"></script>

    <style>
        .form-error input {
            border-color: red;
            border-width: 2px;
        }

        .form-success input {
            border-color: 
        green;
            border-width: 2px;
        }

        .form-error span {
            color: 
        red;
        }

        .success span {
            color: 
        green;
        }

        span.form-error {
            color: 
        red;
        }
    </style>


</head>

<body id="page-top">
    <?php
    // Kiểm tra admin
    if (isset($_SESSION['customerId']) && isset($_SESSION['customerEmail']) && isset($_SESSION['customerPassword'])) :

        // Thông báo
        echo '<script>alert("Bạn không phải là admin")</script>';
        // Chưa đăng nhập thì quay về login
        echo '<meta http-equiv="refresh" content="0;url=../index.php?action=home"/>';

        else :

        // kiểm tra đăng nhập
        if (isset($_SESSION['staffId']) && isset($_SESSION['staffEmail']) && isset($_SESSION['staffPassword'])) :
            // Header
            include "View/header.php";

            // Content
            $ctrl = "dashboard";
            if (isset($_GET['action'])) {
                $ctrl = $_GET['action'];
            }
            include "Controller/" . $ctrl . '.php';

            // Footer
            include "View/footer.php";
        else :
            // Chưa đăng nhập thì quay về login
            include "Controller/staffLogin.php";
            // echo '<meta http-equiv="refresh" content="0;url=../Admin/"/>';
        endif;
    endif;
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="./assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./assets/js/demo/chart-area-demo.js"></script>
    <script src="./assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>