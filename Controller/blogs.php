<?php
$action="blogs";
if(isset($_GET['act']))
{
  $action=$_GET['act'];
}
switch($action){
  // Điều hướng tới trang blogs.php 
  case 'blogs':
    include './View/blogs.php';
    break;
  case 'blogDetail' :
    include './View/blogDetail.php';
    break;
}
?>