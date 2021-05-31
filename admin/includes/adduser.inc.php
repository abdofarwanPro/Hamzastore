<?php
   if ($_SERVER["REQUEST_METHOD"]) {
    require_once '../../includes/db.php';

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
       $role = getvalues("role");


       if (empty($email) || empty($username) || empty($address) || empty($password) || empty($role)) {
           header("Location: ../adduser.php?error=emptyfields");
       } else {
         $password_encrypted = password_hash($password, PASSWORD_DEFAULT);
         $query =  "INSERT INTO customers (customerUsername,customerAddress,customerEmail,customerPassword,role) VALUES (?,?,?,?,?)";
         $stmt = $con -> prepare($query);
         $stmt -> bind_param("sssss", $username,$address,$email,$password_encrypted,$role);
         header("Location: ../customers.php?success=registersuccess");
         $stmt -> execute();
         $stmt -> close();
         $con -> close();
        }
   } 
?>