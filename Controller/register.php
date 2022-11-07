<?php
$action="register";
if(isset($_GET['act']))
{
  $action=$_GET['act'];
}
switch ($action) {
    // Điều hướng đến trang register.php
    case 'register':
        include "View/register.php";
    break;

    // Thực thi đăng ký
    case 'register_action':
        // Kiểm trả request method
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            // khai báo các biến để lấy giá trị nhận về
            $email    = $_POST['txtemail'];
            $password = $_POST['txtpassword'];
            $name     = $_POST['txtname'];
            $address  = $_POST['txtaddress'];
            $phone    = $_POST['txtphone'];
            // mã hóa password
            $cypt=md5($password);
            // sử dụng phương thức register để thêm tài khoản vào database
            $customer=new Customer();
            $result = $customer->register($email,$cypt,$name,$address,$phone);
            if(empty($result)){
                echo '<script>alert("Email này đã được đăng ký!")</script>';
                echo '<meta http-equiv="refresh" content="0;url=../index.php?action=register"/>';
            }
            else {
                // sau khi đăng ký thành công, quay trở về trang login
                include 'View/login.php'; 
                echo '<meta http-equiv="refresh" content="0;url=../index.php?action=login"/>';
            }
        }
    break;
 
}
