<?php
$action="home";
if(isset($_GET['act']))
{
  $action=$_GET['act'];
}
switch($action){
  // Điều hướng tới trang home.php 
  case 'home':
    include './View/home.php';
    break;
}
?>