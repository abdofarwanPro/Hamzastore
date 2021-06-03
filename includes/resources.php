<?php
    function getvalues($value){
        return $_POST["$value"];
    }
    function cleaninput($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function viewProductID($con, $productid){
        $sql = "SELECT * FROM products WHERE facemaskID = $productid";
        return $con -> query($sql); 
    } 

    function viewUserOrderByID($con, $userid){
        $sql = "SELECT * FROM orders WHERE customerID = $userid";
        return $con -> query($sql);
    }

    function viewProductByID($con, $productid){
        $sql = "SELECT * FROM products WHERE facemaskID = $productid";
        return $con -> query($sql); 
    } 
    // view specific vendor by his ID
    function viewVendorByID($con, $vendorID){
        $sql = "SELECT * FROM vendors WHERE vendorID = $vendorID";
        return $con -> query($sql);
    }
    // view specific user by his/her ID
    function viewUserByID($con, $userid){
        $sql = "SELECT * FROM customers WHERE customerID = $userid";
        return $con -> query($sql);
    }
    // view specific order by its ID
    function viewOrderByID($con, $orderid){
        $sql = "SELECT * FROM orders WHERE orderID = $orderid";
        return $con -> query($sql);
    }
       // Query to get all orders 
       function viewAllOrders($con){
        $sql = "SELECT * FROM orders";
        return $con -> query($sql);
    }
         // Query to get all products 
         function viewAllProducts($con){
            $sql = "SELECT * FROM products";
            return $con -> query($sql);
        }
           // Query to get all orders 
           function viewAllUnpaidOrders($con){
            $sql = "SELECT * FROM orders WHERE orderStatus = 'Unpaid'";
            return $con -> query($sql);
        }
    // Query to get all products 
     function viewAllCustomers($con){
        $sql = "SELECT * FROM customers";
        return $con -> query($sql);
    }
    // Query to get all products 
    function viewAllVendors($con){
        $sql = "SELECT * FROM vendors";
        return $con -> query($sql);
    }
    function addProduct($con,$facemaskName,$facemaskDescription,$facemaskPrice,$facemaskQuantity,$facemaskImg,$vendorID){
        $sql = "INSERT INTO products (facemaskName,facemaskDescription,facemaskPrice,facemaskQuantity,facemaskImg,vendorID) VALUES (?,?,?,?,?,?)";
        $stmt = $con -> prepare($sql);
        $stmt -> bind_param("ssssss", $facemaskName,$facemaskDescription,$facemaskPrice,$facemaskQuantity,$facemaskImg,$vendorID);
        return $stmt -> execute();
    }
    function updateProduct($con,$facemaskID,$facemaskName,$facemaskDescription,$facemaskPrice,$facemaskQuantity,$facemaskImg,$vendorID){
        $sql = "UPDATE products SET facemaskName = '$facemaskName', facemaskDescription = '$facemaskDescription', facemaskPrice = '$facemaskPrice' ,facemaskQuantity = '$facemaskQuantity',facemaskImg = '$facemaskImg',vendorID = '$vendorID' WHERE facemaskID = $facemaskID";
        return $con -> query($sql);
    }
    function deleteProduct($con, $facemaskID){
        $sql = "DELETE FROM products WHERE facemaskID = $facemaskID";
        return $con -> query($sql);
    }
    function deleteOrder($con, $orderID){
        $sql = "DELETE FROM orders WHERE orderID = $orderID";
        return $con -> query($sql);
    }
    function deleteCustomer($con, $customerID){
        $sql = "DELETE FROM customers WHERE customerID = $customerID";
        return $con -> query($sql);
    }
    function deleteVendor($con, $vendorID){
        $sql = "DELETE FROM vendors WHERE vendorID = $vendorID";
        return $con -> query($sql);
    }
    function updateOrderStatus($con,$orderID, $orderStatus){
        $sql = "UPDATE orders SET orderStatus = 'Paid' WHERE orderID = $orderID";
        return $con -> query($sql);
    }
    function decreaseFaceMaskQuantity($con,$newFacemaskQuantity,$productid){
        $sql = "UPDATE products SET facemaskQuantity = $newFacemaskQuantity WHERE facemaskID = $productid";
        return $con -> query($sql);
    }

?>