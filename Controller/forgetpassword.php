
<?php
require 'Model/Exception.php';
require 'Model/PHPMailer.php';
require 'Model/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$action="forgetpassword";
if(isset($_GET['act']))
{
    $action=$_GET['act'];
}

switch($action)
{   

    case "forgetpassword":
        include "View/forgetPassword.php";
        break;
    case "forgetpassword_action":
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $email = $_POST['txtemail'];
            $customer=new Customer();
            
            $result=$customer->selectCustomerByEmail($email);

            if(!isset($result['customer_id'])){
                echo '<script>alert("Email không có liên kết tài khoản, Vui lòng kiểm tra lại!")</script>';
                echo '<meta http-equiv="refresh" content="0; url=./index.php?action=forgetpassword"/>';
            }else{
                
                $verify = substr(rand(100000,999999),0 ,6);
                $_SESSION['verify'] = $verify;
                // $link="<a href='http://localhost:80/index.php?action=forgetpassword&act=resetpass&key=".$md5email."&reset=".$md5pass."'>Reset password</a>";
                // setting mailer
                $mail = new PHPMailer(true);
                $mail->IsSMTP(); // telling the class to use SMTP
                //$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server

                // $mail->SMTPDebug  = 1;
                $mail->Host       = "smtp.gmail.com";
                $mail->SMTPAuth   = true;
                $mail->Username = "quantriviendatdat@gmail.com";
                $mail->Password = "nqoaaaadrmuzbsik";
                $mail->SMTPSecure ='tls';
                $mail->Port       = '587';
                                // 
                $mail->SetFrom('quantriviendatdat@gmail.com', 'DatdatStore');
                // echo '<script> alert ("'.$email.'")</script>';
                $mail->AddAddress($email, "reciever_name");
                // echo '<script> alert ("2")</script>';
                //$mail->AddReplyTo("user2@gmail.com', 'First Last");
                $mail->IsHTML(true);
                $mail->Subject= 'Reset Password';
                $mail->Body = 'Mã xác thực của bạn là: <span style="color:#1cc88a;">'.$verify.'</span>';
                // $mail->AltBody    = 'Nhấn vào link để đặt lại mật khẩu!';
                // $mail->MsgHTML($body);
                if($mail->Send())
                {
                    echo '<meta http-equiv="refresh" content="0; url=./index.php?action=forgetpassword&act=verify&email='.$email.'"/>';
                }
                else
                {
                    echo '<script>alert("Mail Error")</script>';
                    echo '<meta http-equiv="refresh" content="0; url=./index.php?action=forgetpassword"/>';
                }
            }
        }else{
            echo '<script> alert ("Vui lòng không bỏ trống !")</script>';
            echo '<meta http-equiv="refresh" content="0; url=./index.php?action=forgetpassword"/>';
        }
        break;

    case "verify":
        include 'View/verifyCode.php';
    break;
    case "verify_action":
        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_SESSION['verify']))
        {
            $verifySession = $_SESSION['verify'];
            $verifyCode = $_POST['txtverifycode'];
            $email = $_POST['txtemail'];
            if($verifyCode != $verifySession)
            {
                echo '<script> alert ("Mã xác thực không đúng!")</script>';
                echo '<meta http-equiv="refresh" content="0; url=./index.php?action=forgetpassword&act=verify&email='.$email.'"/>';
            }
            else
            {
                unset($_SESSION['verify']);
                include 'View/resetPassword.php';
            }
        }
        else 
        {
            echo '<meta http-equiv="refresh" content="0; url=./index.php?action=forgetpassword"/>';
        }
        break;
    case "resetpassword":
        if(isset($_SESSION['verify']))
        {
            include 'View/resetPassword.php';
        }
        else
        {
            echo '<meta http-equiv="refresh" content="0; url=./index.php?action=forgetpassword"/>';
        }
    break;
    case "resetpassword_action":
        if($_SERVER['REQUEST_METHOD']=='POST')
        { 
            $newpassword = md5($_POST['txtnewpassword']);
            $customerId = $_POST['txtid'];
            $customer = new Customer();
            $customer->updatePassword($customerId,$newpassword);
            unset($_SESSION['changePasswordId']);
            echo '<script>alert("Thay đổi mật khẩu thành công");</script>';
            echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login"/>';
        }
    break;
}
?>