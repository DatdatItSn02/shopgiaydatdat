<?php
$action="order";
if(isset($_GET['act']))
{
  $action=$_GET['act'];
}
switch($action){
    case 'orderhistory':
      if(
        isset($_SESSION['customerId'])       && 
        isset($_SESSION['customerName'])     &&
        isset($_SESSION['customerEmail'])    &&
        isset($_SESSION['customerPassword'])
      )
      {
        include './View/customerOrders.php';
      }
      else {
      echo '<script>alert("Bạn cần đăng nhập trước khi xem lịch sử hóa đơn")</script>';
      echo '<meta http-equiv="refresh" content="0;url=../index.php?action=login"/>';
      }
    break;
    case 'order':
      if(
        isset($_SESSION['customerId'])       && 
        isset($_SESSION['customerName'])     &&
        isset($_SESSION['customerEmail'])    &&
        isset($_SESSION['customerPassword'])
      )
      {
        include './View/order.php';
      }
      else {
      echo '<script>alert("Bạn cần đăng nhập trước khi thanh toán")</script>';
      echo '<meta http-equiv="refresh" content="0;url=../index.php?action=cart"/>';
      }
    break;
    case 'order_action' :
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if(isset($_POST['btnVoucher']))
        {
          //Mã voucher người dùng nhập
          $voucherInput = $_POST['txtvoucher'];
          //Lấy ngày hiện tại
          $today = new DateTime('now',);
          $today = $today->format("Y-m-d H:i:s A");
          //Lấy voucher
          $voucher = new Voucher();
          $log = $voucher->selectVoucherInput($voucherInput);
          if($log) {
          //Danh mục, Sản phẩm, Khách hàng bao gồm và loại trừ của voucher
          $logInCategory = explode(':',$log['include_category']);
          $logExCategory = explode(':',$log['exclude_category']);
          $logInProduct = explode(':',$log['include_product']);
          $logExProduct = explode(':',$log['exclude_product']);
          $logInCustomer = explode(':',$log['include_customer']);
          $logExCustomer = explode(':',$log['exclude_customer']);
          //Hạn sử dụng của voucher
          $logStart = new DateTime($log['voucher_start']);
          $logEnd = new DateTime($log['voucher_end']);
          //Kiểm tra voucher code có tồn tại không
          
            $flag = true;
            // Kiểm tra hạn sử dụng
            if($logStart->format("Y-m-d H:i:s A") > $today || $logEnd->format("Y-m-d H:i:s A") < $today) {
              
              $flag = false;
            };
            // Kiểm tra người dùng có được sài voucher hay không
            $customerId = $_POST['txtcustomerid'];
            if(in_array('All',$logExCustomer)){
              
              $flag = false;
            }
            if(in_array($customerId,$logExCustomer)){
              
              $flag = false;
            }
            if(!in_array('All',$logInCustomer)){
              if(!in_array($customerId,$logInCustomer)){
                
                $flag = false;
              }
            }
            // Kiểm tra có sản phẩm và danh mục sản phẩm nào không được giảm giá không
            foreach($_SESSION['cart'] as $key=>$item){
              // Kiểm tra danh mục
              if(in_array('All',$logExCategory)){
                
                $flag = false;
              }
              if(in_array($item['category'],$logExCategory)){
                
                $flag = false;
              }
              if(!in_array('All',$logInCategory)){
                if(!in_array($item['category'],$logInCategory)){
                  
                  $flag = false;
                }
              }
              // Kiểm tra sản phẩm
              if(in_array('All',$logExProduct)){
                
                $flag = false;
              }
              if(in_array($item['productId'],$logExProduct)){
                
                $flag = false;
              }
              if(!in_array('All',$logInProduct)){
                if(!in_array($item['productId'],$logInProduct)){
                  $flag = false;
                }
              }
            }
            if($flag)
            {
              $total = 0;
              foreach($_SESSION['cart'] as $key=>$item){
                $total += $item['quantity']*($item['price']*(1-$item['discount']));
              }
              switch($log['type_id']){
                //Giảm giá theo phần trăm
                case 1:
                  $total = $total*(1-$log['value']);
                break;
                //Giảm giá theo giá
                case 2:
                  $total = $total - $log['value'];
                break;
              }
              //Gán lại tổng tiền cho hóa đơn
              $_SESSION['total'] = $total;
              echo '<script>alert("Áp dụng mã thành công")</script>';
              echo '<meta http-equiv="refresh" content="0;url=../index.php?action=order&voucher='.$voucherInput.'"/>';
            }else
            {
              echo '<script>alert("Áp dụng mã không thành công")</script>';
              echo '<meta http-equiv="refresh" content="0;url=../index.php?action=order"/>';
            }
          }
          else {
              echo '<script>alert("Áp dụng mã không thành công")</script>';
              echo '<meta http-equiv="refresh" content="0;url=../index.php?action=order"/>';    
          }
        }
        else 
        {
          //Khởi tạo modal cần thiết
          $order = new Order();
          $orderDetail = new OrderDetail();
          $product = new Product();
          $voucher = new Voucher();
          //Tạo biến lưu thông tin đơn hàng
          $customerId = $_POST['txtcustomerid'];
          $customerName = $_POST['txtcustomername'];
          $customerEmail = $_POST['txtcustomeremail'];
          $customerAddress = $_POST['txtcustomeraddress'];
          $customerPhone = $_POST['txtcustomerphone'];
          $total = $_POST['txttotal'];
          $status = "Đặt hàng";
          $payment = $_POST['txtpayment'];
          $paymentInfo = $_POST['txtpaymentinfo'];
          $message = $_POST['txtmessage'];
          $security = $_POST['txtsecurity'];
          $voucherCode = "";
          //Gán giá trị cho biến voucher nếu người dùng sử dụng voucher
          if(isset($_POST['txtvoucher'])){
            $voucherCode = $_POST['txtvoucher'];
          }
          //Tạo hóa đơn
          $set = $order->insertSingle($customerId,$customerName,$customerEmail,$customerAddress,$customerPhone,$total,$voucherCode,$payment,$paymentInfo,$message,$security,$status);
          
          //Tạo chi tiết hóa đơn
          $orderId = $order->selectIdOrderNew()['id'];

          foreach($_SESSION['cart'] as $key=>$item){
            $orderDetail->insertSingle($orderId,$item['productId'],$item['quantity'],$item['total'],"");
            //Giảm số lượng sản phẩm trong database
            $product->decreaseQuantity($item['productId'], $item['quantity']);
          }
          //Giảm số lượng voucher nếu người dùng sử dụng voucher
          if(isset($_POST['txtvoucher']) && $_POST['txtvoucher']!=""){
            $voucherInfo = $voucher->selectVoucherInput($voucherCode);
            $voucher->decreaseQuantity($voucherInfo['id'],1);
          }
          //Xóa giỏ hàng
          unset($_SESSION['cart']);
          //Thông báo và điều hướng về trang home
          echo '<script>alert("Thanh toán thành công")</script>';
          echo '<meta http-equiv="refresh" content="0;url=../index.php?action=home"/>';
        }
      }
    break;
}
