<?php include("includes/db.php"); include("includes/auth_session.php");?>
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
          <li class="nav-item active">
            <a class="nav-link" href="customer.php">Profile</a>
            <span class="sr-only">(current)</span>
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
         <!-- change or remove this -->
        <div class="my-4 alert alert-success" role="alert">
         Welcome <?php echo $_SESSION['username']; ?>!
        </div>
        <?php if($_SESSION['username'] == 'admin'){
            // isn't admin, redirect them to a different page
            echo "<div class='my-4 alert alert-warning' role='alert'>Since you are admin, You can visit the <a href='admin/'>admin panel</a> </div>";
        } ?>
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


          <hr><br>
         <div class="table">
           <h3>Orders</h3>
            <table class="table table-striped table-bordered">
              <tr>
                   <th width="40%">OrderID</th>
                   <th width="30%">Order Date</th>
                   <th width="20%">Total Price</th>
                   <th width="5%">Action</th>
              </tr>
              <tr>
                   <td>12</td>
                   <td>20 / 04 / 2021</td>
                   <td>$ 2,300</td>
                   <td><a href="view.php?orderid=<?php echo $values["order_id"]; ?>"><span class="text-info">View</span></a></td>
              </tr>
              <tr>
                   <td>153</td>
                   <td>21 / 04 / 2021</td>
                   <td>$ 1,150</td>
                   <td><a href="view.php?orderid=<?php echo $values["order_id"]; ?>"><span class="text-info">View</span></a></td>
              </tr>
            </table>
         </div>



        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
