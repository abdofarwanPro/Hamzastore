<?php 

require_once '../includes/db.php';
require_once '../includes/resources.php';

// get ?productid=# from get request and give it to the deleteProduct function
if(isset($_GET['productid'])){
    $facemaskID = htmlentities(strip_tags($_GET['productid']));
    deleteProduct($con, $facemaskID);
    header("Location: products.php");
}

if(isset($_GET['orderid'])){
    $orderID = htmlentities(strip_tags($_GET['orderid']));
    deleteOrder($con, $orderID);
    header("Location: orders.php");
}



if(isset($_GET['vendorid'])){
    $vendorID = htmlentities(strip_tags($_GET['vendorid']));
    deleteVendor($con, $vendorID);
    header("Location: vendors.php");
}


if(isset($_GET['customerid'])){
    $customerID = htmlentities(strip_tags($_GET['customerid']));
    deleteCustomer($con, $customerID);
    header("Location: customers.php");
}
?> 