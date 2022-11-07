<?php
if(isset($_SESSION['customerId']) && isset($_SESSION['customerEmail']) && isset($_SESSION['customerPassword']))
{
     // Thông báo
     echo '<script>alert("Bạn không phải là staff")</script>';
     // Quay về trang client
     echo '<meta http-equiv="refresh" content="0;url=../index.php?action=home"/>';
}
elseif(empty($_SESSION['staffId']) && empty($_SESSION['staffEmail']) && empty($_SESSION['staffPassword']))
{
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
    }else {
        $flag = false;
        // Thông báo
        echo '<script>alert("Vui lòng đăng nhập để truy cập vào trang này")</script>';
        include 'View/staffLogin.php';   
    }
}
else
{
    $flag = true;
}

$action="staffLogin";
if(isset($_GET['act']))
{
  $action=$_GET['act'];
}

switch ($action) {

    // Điều hướng tới trang staffLogin.php
    case 'staffLogin':
        if($flag){
            include 'View/staffLogin.php';
        }
    break;

    case 'staffLogin_action':
        // Kiểm tra request method
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
        // khai báo các biến để lấy giá trị nhận về
        $username = $_POST['txtusername'];
        $password = $_POST['txtpassword'];
        // mã hóa mật khẩu
        $cypt = md5($password);
        // Sử dụng hàm checkLogin để kiểm tra đăng nhập
        $staff = new Staff();
        $log = $staff->checkLogin($username,$cypt);
        if($log==true)
        {
            // đăng ký với session
            $_SESSION['staffId']       = $log['staff_id'];
            $_SESSION['staffSex']      = $log['sex'];
            $_SESSION['staffRole']     = $log['role'];
            $_SESSION['staffName']     = $log['name'];
            $_SESSION['staffEmail']    = $log['email'];
            $_SESSION['staffImage']    = $log['image'];
            $_SESSION['staffPhone']    = $log['phone'];
            $_SESSION['staffAddress']  = $log['address'];
            $_SESSION['staffPassword'] = $log['password'];
            $_SESSION['staffBirthday'] = $log['birthday'];
            // quay lại trang home
            echo '<meta http-equiv="refresh" content="0;url=../Admin/"/>';
        }
        else{
            // Thông báo
            echo '<script> alert("Đăng nhập không thành công");</script>';
            // Quay lại trang login.php
            include 'View/staffLogin.php';
        }
        }
        break;
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
        
        echo '<meta http-equiv="refresh" content="0;url=../Admin/"/>';
        }
        // Quay về trang home
        break;
}

?>