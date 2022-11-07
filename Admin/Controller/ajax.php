<?php
$action = "";
if (isset($_GET['act'])) {
    $action = $_GET['act'];
}
switch($action) {
    //====================================================================
    //                               Orders
    //====================================================================
    case "ordersTypes":
        include "./View/ajaxTemplate/orderTable.php";
    break;

    //====================================================================
    //                               Products
    //====================================================================
    case "productsSearchName":
        include "./View/ajaxTemplate/productTable.php";
    break;

}

?>