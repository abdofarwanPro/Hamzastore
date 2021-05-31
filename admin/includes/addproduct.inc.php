<?php 
require_once '../../includes/db.php';
require_once '../../includes/resources.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $facemaskName= cleaninput(getvalues("facemaskName"));
    $facemaskDescription= cleaninput(getvalues("facemaskDescription"));
    $facemaskPrice= cleaninput(getvalues("facemaskPrice"));
    $facemaskQuantity= cleaninput(getvalues("facemaskQuantity"));
    $facemaskImg= getvalues("facemaskImg");
    $vendorID= cleaninput(getvalues("vendorID"));

    if (empty($facemaskName) || empty($facemaskDescription) || empty($facemaskPrice) || empty($facemaskQuantity) || empty($facemaskImg) || empty($vendorID)) {
        # code...
        header("Location: ../addproduct.php?error=emptyfields");
    } else {
        $addproduct = addProduct($con,$facemaskName,$facemaskDescription,$facemaskPrice,$facemaskQuantity,$facemaskImg,$vendorID);
        ($addproduct  == 1 ) ? header("Location: ../products.php?success=productadded") : header("Location: ../addproduct.php?error=failed");
    }
}
?>