<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
set_include_path(get_include_path() . PATH_SEPARATOR . 'Model/');
spl_autoload_extensions('.php'); // phần mở rộng
spl_autoload_register();
session_start();
include "./Model/fnAddCart.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Giày Datdat</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- Normalize -->
    <link rel="stylesheet" href="./node_modules/normalize.css/normalize.css">
    <!-- Google font -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link href="./assets/css/google-font.css" rel="stylesheet">
    
    <script src="./assets/js/js-fontawesomekit.js" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <!-- CSS  -->
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <!-- <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.0/css/pro.min.css"> -->
</head>

<body>
    <h1>Hello world</h1>
    <!-- Header -->
    <?php
    include "View/header.php";
    ?>
    <!-- Content -->
    <div style="padding-top: 100px;">
        <div class="row">
            <?php
            // Mặc định vào trang home
            $ctrl = "home";
            if (isset($_GET['action'])) {
                $ctrl = $_GET['action'];
            }
            include "Controller/" . $ctrl . '.php';
            ?>
        </div>
    </div>
    <!-- Footer -->
    <?php
    // include "View/footer.php";
    ?>
</body>

</html>