<?php
    $con = mysqli_connect("localhost","root","","U4");
    // This is just to check the connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
