<?php
   if ($_SERVER["REQUEST_METHOD"]== "POST") {

   	  // create a mysql connection
   	  $mysql_host= "localhost";
   	  $mysql_username = "root";
   	  $mysql_password = "";
   	  $mysql_db = "U4";

   	  $mysqli = new mysqli ($mysql_host,$mysql_username,$mysql_password,$mysql_db);
   	  if ($mysqli -> connect_error) {
   	  	 die('error: ('.$mysqli -> connect_error.')'.$mysqli-> connect_error);
   	  } else {
   	  	print("connection established");
   	  }

      $facemaskName = $_POST["facemaskName"];
      $facemaskDescription    = $_POST["facemaskDescription"];
      $facemaskPrice  = $_POST['facemaskPrice'];
      $facemaskQuantity    = $_POST["facemaskQuantity"];
      $facemaskImg    = $_POST["facemaskImg"];



      $statement= $mysqli-> prepare(
            "INSERT INTO products(`facemaskName`,`facemaskDescription`,`facemaskPrice`,`facemaskQuantity`,`facemaskImg`) VALUES (?,?,?,?,?)"
      );

      $statement -> bind_param('sssss', $facemaskName, $facemaskDescription,$facemaskPrice,$facemaskQuantity,$facemaskImg);
      if ($statement-> execute()) {
      	print("success");
      } else {
      	print("error");
      }

   }

?>
