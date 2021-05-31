<?php

    if(isset($_POST['submit'])){

        require 'db.php';
        $username= $_POST['username'];
        $password= $_POST['password'];

        if(empty($username) || empty($password)){
            header("Location: ../login.php?error=emptyfields");
            exit(); 
        }else{
            $sql= "SELECT * FROM customers WHERE customerUsername= ?";
            $stmt= $con->prepare($sql);
            if(!$stmt){
                header("Location: ../login.php?error=sqlerror");
                exit();
            }else{
               $stmt->bind_param('s', $username);
               $stmt->execute();
               $result= $stmt->get_result();
               $row= $result->fetch_assoc();
                if($row){
                    $passCheck= password_verify($password, $row["customerPassword"]);
                    if($passCheck == false){
                        header("Location: ../login.php?error=wrongpass");
                         exit();
                    } elseif($passCheck ==  true){
                        session_start();
                        $isloggedin = true;
                        $_SESSION["isloggedin"]= $isloggedin;
                        $_SESSION["sessionId"]= $row["customerID"];
                        $_SESSION["username"]= $row["customerUsername"];
                        $_SESSION["role"]= $row["role"];
                        header("Location: ../shop.php?success=loggedin");
                        exit();
                        
                    }else{
                        header("Location: ../login.php?error=nouserwitheusername$username".$username);
                        exit();
                    }
                    
                }else{
                    header("Location: ../login.php?error=nouser");
                     exit();
                }
            }
        

        }
    }else {
        header("Location: ../index.php?error=accessforbidden");
        exit();
    }


?>