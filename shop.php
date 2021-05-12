<?php include("includes/db.php"); include("includes/auth_session.php");

if(isset($_POST["add_to_cart"])) {
      if(isset($_SESSION["cart"])) {
           $item_array_id = array_column($_SESSION["cart"], "mask_id");
           if(!in_array($_GET["id"], $item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                     'mask_id'       =>  $_GET["id"],
                     'mask_name'     =>  $_POST["hidden_name"],
                     'mask_price'    =>  $_POST["hidden_price"],
                     'mask_quantity' =>  $_POST["quantity"]);
                $_SESSION["cart"][$count] = $item_array;
           } else {
                echo '<script>alert("Item is already in the cart")</script>';
                echo '<script>window.location="shop.php"</script>';
           }
      } else {
           $item_array = array(
                'mask_id'       =>   $_GET["id"],
                'mask_name'     =>   $_POST["hidden_name"],
                'mask_price'    =>   $_POST["hidden_price"],
                'mask_quantity' =>   $_POST["quantity"]
           );
           $_SESSION["cart"][0] = $item_array;
      }
 }
 if(isset($_GET["action"])) {
      if($_GET["action"] == "delete") {
           foreach($_SESSION["cart"] as $keys => $values) {
                if($values["mask_id"] == $_GET["id"]){
                     unset($_SESSION["cart"][$keys]);
                     echo '<script>window.location="shop.php"</script>';
                }
           }
      }
 }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="U8-Part2">
  <meta name="author" content="abdofarwan">

  <title>U8 - Hamza Store</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Hamza Store</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customer.php">Profile</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="shop.php">Shop</a>
            <span class="sr-only">(current)</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php if($_SESSION["loggedIn"] != true){ echo 'login.php'; } else {echo 'logout.php';}?>"><?php if($_SESSION["loggedIn"] != true){ echo 'Login'; } else {echo 'Logout';}?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Hamza's Store</h1>
        <p class="my-4">The best quality facemask store!</p>
         <!-- change or remove this -->
        <div class="my-4 alert alert-success" role="alert">
         Welcome <?php echo $_SESSION['username']; ?>!
        </div>
        <div class="list-group">
          <a href="customer.php" class="list-group-item">My Orders</a>
          <a href="shop.php" class="list-group-item">Shop</a>
          <a class="list-group-item" href="<?php if($_SESSION["loggedIn"] != true){ echo 'login.php'; } else {echo 'logout.php';}?>"><?php if($_SESSION["loggedIn"] != true){ echo 'Login'; } else {echo 'Logout';}?></a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
      <br>
        <div class="row">
          <?php
          $query = "SELECT * FROM products ORDER BY facemaskID ASC";
          $result = mysqli_query($con , $query);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
              // code...

           ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="<?php echo $row["facemaskImg"]; ?>" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="shop.php"><?php echo $row["facemaskName"]; ?></a>
                </h4>
                <h5>$<?php echo $row["facemaskPrice"]; ?></h5>
                <p class="card-text"><?php echo $row["facemaskDescription"]; ?></p>
              </div>
              <div class="card-footer">
                <form class="" action="shop.php?action=add&id=<?php echo $row["facemaskID"]; ?>" method="post">
                  <input type="number" name="quantity" value="1" min="1" max="<?php echo $row["facemaskQuantity"]; ?>">
                  <input type="hidden" name="hidden_name" value="<?php echo $row["facemaskName"]; ?>">
                  <input type="hidden" name="hidden_price" value="<?php echo $row["facemaskPrice"]; ?>">
                  <button type="submit" name="add_to_cart" class="btn btn-primary btn-sm">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
     <?php
   }
}
      ?>
    <!-- The Cart  -->
    <hr><br>
   <div class="table">
     <h3>Cart</h3>
      <table>
        <tr>
             <th width="40%">Item Name</th>
             <th width="10%">Quantity</th>
             <th width="20%">Price</th>
             <th width="15%">Total</th>
             <th width="5%">Action</th>
        </tr>
        <?php
        if(!empty($_SESSION["cart"])){
             $total = 0;
             foreach($_SESSION["cart"] as $keys => $values) {
        ?>
        <tr>
             <td><?php echo $values["mask_name"]; ?></td>
             <td><?php echo $values["mask_quantity"]; ?></td>
             <td>$ <?php echo $values["mask_price"]; ?></td>
             <td>$ <?php echo number_format($values["mask_quantity"] * $values["mask_price"], 2); ?></td>
             <td><a href="shop.php?action=delete&id=<?php echo $values["mask_id"]; ?>"><span class="text-danger">Remove</span></a></td>
        </tr>
        <?php
               $total = $total + ($values["mask_quantity"] * $values["mask_price"]);
             }
        ?>
        <tr>
             <td colspan="3" align="right">Total</td>
             <td align="right">$ <?php echo number_format($total, 2); ?></td>
             <td><button type="button" class="btn btn-success btn-sm">Order</button></td>
        </tr>
        <?php
        }
        ?>
      </table>
   </div>

   <!-- End of Cart -->


        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Hamza Store 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
