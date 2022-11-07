<?php
$action="products";
if(isset($_GET['act']))
{
  $action=$_GET['act'];
}
switch($action){
  // Điều hướng tới trang products.php 
  case 'products':
    include './View/products.php';
    break;
  
  case 'productDetail' :
    include './View/productDetail.php';
    break;
}
?>