<?php
include("includes/db.php");
include("includes/auth_session.php");
session_start();
// check if username is admin
if($_SESSION['username'] !== 'admin'){
    // isn't admin, redirect them to a different page
    header("Location: /U4/index.php");
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Admin Panel</h1>
    <h3>Add Facemask</h3>
      <form action="facemask.php" method="post">
         <input type="text" name="facemaskName" placeholder="Facemask Name"required>
         <input type="textarea" name="facemaskDescription" placeholder="Facemask Description"required>
         <input type="text" name="facemaskPrice" placeholder="Facemask Price"required>
         <input type="text" name="facemaskQuantity" placeholder="Quantity Available"required>
         <input type="text" name="facemaskImg" placeholder="Image URL images/5.jpeg"required>
         <input type="submit" name="submit" value="Add Facemask!">
      </form>
  </body>
</html>
