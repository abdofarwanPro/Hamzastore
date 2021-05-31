<?php  require_once 'includes/header.php'; include("includes/db.php"); include("includes/auth_session.php"); require_once 'includes/resources.php'; $count=0;?>

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
        <?php if($_SESSION['username'] == 'admin'){
            // isn't admin, redirect them to a different page
            echo "<div class='my-4 alert alert-warning' role='alert'>Since you are admin, You can visit the <a href='admin/'>admin panel</a> </div>";
        } ?>
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


          <hr><br>
         <div class="table">
           <h3>My Orders</h3>
            <table class="table table-striped table-bordered">
              <tr>
                   <th width="1%">OrderID</th>
                   <th width="20%">Order Date</th>
                   <th width="20%">Total Price</th>
                   <th width="10%">Status</th>
                   <th width="10%">Action</th>
              </tr>

              <?php
                $userid = $_SESSION['sessionId'];
                // query all orders my by specific user
                $query = viewUserOrderByID($con, $userid);
                // while loop to display all orders
                while ($a = $query -> fetch_array()) {
                    # code...
                    $count +=1;
                    ?>
                    <tr>
                    <td><?php echo $a["orderID"];?></td>
                    <td><?php echo $a["orderDate"];?></td>
                    <td>$<?php echo $a["orderTotal"];?></td>
                    <td><?php echo $a["orderStatus"];?></td>
                    <td><a href="invoice.php?orderid=<?php echo $a["orderID"];?>"><span class="text-info">Invoice</span></a></td>
                    </tr>
            <?php
                }
            ?>


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

<?php  require_once 'includes/footer.php'; ?>

