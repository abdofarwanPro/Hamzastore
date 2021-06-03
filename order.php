<?php 
require_once 'includes/db.php';
require_once 'includes/resources.php';


$productid= getvalues("productid");
$quantity= getvalues("quantity");
$userid = getvalues("userid");

$query = viewProductID($con, $productid);
$a = $query -> fetch_array();
$productprice = $a["facemaskPrice"];
$newFacemaskQuantity = $a["facemaskQuantity"] - $quantity;


if ($productprice * $quantity > 50) {
    $ordertotal = $productprice * $quantity * 0.9;
    $discount = "true";
} else {
    $ordertotal = $productprice * $quantity;
    $discount = "false";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($productid) || empty($quantity) || empty($userid) ) {
        header("Location: store.php?error=emptyfields");
    } else {
        $query = "INSERT INTO orders (customerID,facemaskID,quantity,orderTotal,discount) VALUES (?,?,?,?,?)";
        $stmt = $con -> prepare($query);
        $stmt -> bind_param("sssss", $userid,$productid,$quantity,$ordertotal,$discount);
        decreaseFaceMaskQuantity($con, $newFacemaskQuantity, $productid);
        header("Location: customer.php?success=orderadded");
        $stmt -> execute();
        $stmt -> close();
        $con -> close();

    }
}
?>