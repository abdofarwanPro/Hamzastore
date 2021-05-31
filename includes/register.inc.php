<?php
   if ($_SERVER["REQUEST_METHOD"]) {
       require "db.php";

       function cleaninput($data){
           $data = trim($data);
           $data = stripcslashes($data);
           $data = htmlspecialchars($data);
           return $data;
       }

       function getvalues($value){
           return $_POST["$value"];
       }

       $email = getvalues("email");
       $username = getvalues("username");
       $address = getvalues("address");
       $password = getvalues("password");

       if (empty($email) || empty($username) || empty($address) || empty($password)) {
           header("Location: register.php?error=emptyfields");
       } else {
         $password_encrypted = password_hash($password, PASSWORD_DEFAULT);
         $query =  "INSERT INTO customers (customerUsername,customerAddress,customerEmail,customerPassword) VALUES (?,?,?,?)";
         $stmt = $con -> prepare($query);
         $stmt -> bind_param("ssss", $username,$address,$email,$password_encrypted);
         header("Location: ../login.php?success=registersuccess");
         $stmt -> execute();
         $stmt -> close();
         $con -> close();
        }
   } 
?>