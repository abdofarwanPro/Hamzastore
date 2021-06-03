<?php 

require_once 'db.php';
require_once 'resources.php';

// get ?productid=# from get request and give it to the deleteProduct function
if(isset($_GET['orderid'])){
    $orderID = htmlentities(strip_tags($_GET['orderid']));
    $orderStatus = "Paid";

}
    updateOrderStatus($con,$orderID, $orderStatus);
    header("Location: ../invoice.php?orderid=$orderID");
?>  