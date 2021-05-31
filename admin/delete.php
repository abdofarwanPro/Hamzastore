<?php 

require_once '../includes/db.php';
require_once '../includes/resources.php';

// get ?productid=# from get request and give it to the deleteProduct function
if(isset($_GET['productid'])){
    $facemaskID = htmlentities(strip_tags($_GET['productid']));
}
    deleteProduct($con, $facemaskID);
    header("Location: products.php");
?> 