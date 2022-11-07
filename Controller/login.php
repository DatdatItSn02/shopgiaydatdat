<?php
$action="login";
if(isset($_GET['act']))
{
  $action=$_GET['act'];
}
switch ($action) {

    // Điều hướng tới trang login.php
    case 'login':
        include 'View/login.php';
        break;

    // Thực thi đăng nhập và lưu thông tin user vào session
    case 'login_action':
        // Kiểm tra request method
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
        // khai báo các biến để lấy giá trị nhận về
        $username = $_POST['txtusername'];
        $password = $_POST['txtpassword'];
        // mã hóa mật khẩu
        $cypt = md5($password);
        // Sử dụng hàm checkLogin để kiểm tra đăng nhập
        $customer = new Customer();
        $log = $customer->checkLogin($username,$cypt);
        if($log==true)
        {
            // đăng ký với session
            $_SESSION['customerId']       = $log['customer_id'];
            $_SESSION['customerSex']      = $log['sex'];
            $_SESSION['customerName']     = $log['name'];
            $_SESSION['customerEmail']    = $log['email'];
            $_SESSION['customerImage']    = $log['image'];
            $_SESSION['customerPhone']    = $log['phone'];
            $_SESSION['customerAddress']  = $log['address'];
            $_SESSION['customerPassword'] = $log['password'];
            $_SESSION['customerBirthday'] = $log['birthday'];
            // quay lại trang home
            echo '<meta http-equiv="refresh" content="0;url=../index.php?action=home"/>';
        }
        else{
            // Thông báo
            echo '<script> alert("Sai tài khoản hoặc mật khẩu");</script>';
            // Quay lại trang login.php
            echo '<meta http-equiv="refresh" content="0;url=../index.php?action=login"/>';
        }
        }
        break;
    
    // Thực thi đăng xuất
    case 'logout':
        if(
        // Staff
        isset($_SESSION['staffId'])       && 
        isset($_SESSION['staffSex'])      &&
        isset($_SESSION['staffRole'])     &&
        isset($_SESSION['staffName'])     &&
        isset($_SESSION['staffEmail'])    &&
        isset($_SESSION['staffImage'])    &&
        isset($_SESSION['staffPhone'])    &&
        isset($_SESSION['staffAddress'])  &&
        isset($_SESSION['staffPassword']) &&
        isset($_SESSION['staffBirthday'])
         )
        {
        // xóa session
            // Staff
        unset($_SESSION['staffId']); 
        unset($_SESSION['staffSex']);
        unset($_SESSION['staffRole']);
        unset($_SESSION['staffName']);
        unset($_SESSION['staffEmail']);
        unset($_SESSION['staffImage']);
        unset($_SESSION['staffPhone']);
        unset($_SESSION['staffAddress']);
        unset($_SESSION['staffPassword']);
        unset($_SESSION['staffBirthday']);
        }
        else {
            if (
                // xóa session
                    // Customer
                isset($_SESSION['customerId'])       && 
                isset($_SESSION['customerSex'])      &&
                isset($_SESSION['customerName'])     &&
                isset($_SESSION['customerEmail'])    &&
                isset($_SESSION['customerImage'])    &&
                isset($_SESSION['customerPhone'])    &&
                isset($_SESSION['customerAddress'])  &&
                isset($_SESSION['customerPassword']) &&
                isset($_SESSION['customerBirthday']) 
            ) {
                unset($_SESSION['customerId']);
                unset($_SESSION['customerSex']);
                unset($_SESSION['customerName']);
                unset($_SESSION['customerEmail']);
                unset($_SESSION['customerImage']);
                unset($_SESSION['customerPhone']);
                unset($_SESSION['customerAddress']);
                unset($_SESSION['customerPassword']);
                unset($_SESSION['customerBirthday']);
            }
        };
        // Quay về trang home
        echo '<meta http-equiv="refresh" content="0;url=../index.php?action=home"/>';
        break;
}
