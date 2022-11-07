<?php
$action="cart";
if(isset($_GET['act']))
{
  $action=$_GET['act'];
}
switch($action){
    // Điều hướng tới trang cart.php 
    case 'cart':
        include './View/cart.php';
    break;
    
    case 'addcart':
      if($_SERVER['REQUEST_METHOD']=='POST')    
      {
        $productId = $_POST['txtid'];
        $quantity = $_POST['quantity'];
        fnAddCart($productId,$quantity);
        echo '<meta http-equiv="refresh" content="0;url=../index.php?action=products"/>';
      }
    break;

    case 'increaseQuantity':
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $product = new Product();
        $result = $product->selectSingle($id);
        if($result['quantity']>$_SESSION['cart'][$id]['quantity']){
          $_SESSION['cart'][$id]['quantity'] ++;
        }
        else echo '<script>alert("Cửa hàng không còn đủ sản phẩm này!")</script>';
      }
      echo '<meta http-equiv="refresh" content="0;url=../index.php?action=cart"/>';
    break;

    case 'decreaseQuantity':
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        if($_SESSION['cart'][$id]['quantity']>1){
          $_SESSION['cart'][$id]['quantity'] --;
        }
      }
      echo '<meta http-equiv="refresh" content="0;url=../index.php?action=cart"/>';
    break;

    case 'deleteItem':
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
      }
      echo '<meta http-equiv="refresh" content="0;url=../index.php?action=cart"/>';
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
}
