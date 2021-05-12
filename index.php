<?php include("includes/db.php"); session_start();?>
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
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customer.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
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
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>
     <?php
   }
}
      ?>

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
