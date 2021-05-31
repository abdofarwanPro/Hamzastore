<?php 
require_once '../../includes/db.php';
require_once '../../includes/resources.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $facemaskID= getvalues("facemaskID");
    $facemaskName= cleaninput(getvalues("facemaskName"));
    $facemaskDescription= cleaninput(getvalues("facemaskDescription"));
    $facemaskPrice= cleaninput(getvalues("facemaskPrice"));
    $facemaskQuantity= cleaninput(getvalues("facemaskQuantity"));
    $facemaskImg= getvalues("facemaskImg");
    $vendorID= cleaninput(getvalues("vendorID"));


    if (empty($facemaskID) ||empty($facemaskName) || empty($facemaskDescription) || empty($facemaskPrice) || empty($facemaskQuantity) || empty($facemaskImg) || empty($vendorID)) {
        # code...
        header("Location: ../modify.php?productid=$productid&error=emptyfields");
    } else {
        $updateproduct = updateProduct($con,$facemaskID,$facemaskName,$facemaskDescription,$facemaskPrice,$facemaskQuantity,$facemaskImg,$vendorID);
        ($updateproduct  == 1 ) ? header("Location: ../modify.php?productid=$facemaskID&success=productupdated") : header("Location: ../modify.php?productid=$facemaskID&error=failed");
    }
}
?>