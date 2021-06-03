<?php require_once 'includes/header.php'; include("includes/db.php"); include("includes/auth_session.php");?>

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
            <a class="nav-link" href="<?php if($_SESSION["isloggedin"] != true){ echo 'login.php'; } else {echo 'logout.php';}?>"><?php if($_SESSION["isloggedin"] != true){ echo 'Login'; } else {echo 'Logout';}?></a>
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
          <a class="list-group-item" href="<?php if($_SESSION["isloggedin"] != true){ echo 'login.php'; } else {echo 'logout.php';}?>"><?php if($_SESSION["isloggedin"] != true){ echo 'Login'; } else {echo 'Logout';}?></a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
      <br>
        <div class="row">
          <?php
          $query = "SELECT * FROM products WHERE facemaskQuantity > 0 ORDER BY facemaskID ";
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
                 <?php echo $row["facemaskName"]; ?>
                </h4>
                <h5>$<?php echo $row["facemaskPrice"]; ?></h5>
                <p class="card-text"><?php echo $row["facemaskDescription"]; ?></p>
              </div>
              <div class="card-footer">
                <form class="" action="order.php" method="POST">
                  <input type="number" name="quantity" value="1" min="1" max="<?php echo $row["facemaskQuantity"]; ?>">
                  <input type="hidden" name="productid" value="<?php echo $row["facemaskID"];?>">
                  <input type="hidden" name="userid" value="<?php echo $_SESSION['sessionId'];?>">
                  <button type="submit" name="add_to_cart" class="btn btn-primary btn-sm">Buy now</button>
                </form>
              </div>
            </div>
          </div>
     <?php
   }
}
      ?>

   <!-- End of Cart -->


        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php require_once 'includes/footer.php'; ?>
