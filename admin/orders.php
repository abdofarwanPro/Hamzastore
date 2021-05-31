<?php include("../includes/db.php"); include("../includes/auth_session.php"); require_once '../includes/resources.php'; 


// check if username is admin
if($_SESSION['username'] !== 'admin'){
  // isn't admin, redirect them to a different page
  header("Location: /Hamzastore/index.php");
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
  <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
</head>
<body>
  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">HamzaStore Admin Panel</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="/Hamzastore/">Go Back To Store</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customers.php">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vendors.php">
              <span data-feather="bar-chart-2"></span>
              Vendors
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Add data</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link" href="addproduct.php">
              <span data-feather="file-text"></span>
              Product
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adduser.php">
              <span data-feather="file-text"></span>
              User
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addvendor.php">
              <span data-feather="file-text"></span>
              Vendor
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <h2>All Orders</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#ID</th>
              <th>FacemaskID/Name</th>
              <th>Vendor / Address / Phone</th>
              <th>Quantity</th>
              <th>OrderTotal</th>
              <th>CustomerID/Name</th>
              <th>Order Date/Time</th>
              <th>Discount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          <?php 
                $query = viewAllOrders($con);
                $count = 0;
                while ($order = $query -> fetch_array()) {
                    # code...
                    $productid = $order["facemaskID"];
                    $userid = $order["customerID"];

                    // get product info from order
                    $product_query = viewProductByID($con, $productid);
                    $product = $product_query -> fetch_array();
                    $vendorid = $product["vendorID"];
    
                    // get user info from order 
                    $user_query = viewUserByID($con, $userid);
                    $user = $user_query -> fetch_array();
                    // get vendor info from order
                    $vendor_query = viewVendorByID($con, $vendorid);
                    $vendor = $vendor_query -> fetch_array();

                    $count +=1;
                    ?>
                    <tr>
                    <td><?php echo $order["orderID"];?></td>
                    <td><?php echo $order["facemaskID"];?> ~ <?php echo $product["facemaskName"];?></td>
                    <td><?php echo $vendor["vendorname"];?> - <?php echo $vendor["address"];?> - <?php echo $vendor["phone"];?></td>
                    <td><?php echo $order["quantity"];?></td>
                    <td>$<?php echo $order["orderTotal"];?></td>
                    <td><?php echo $order["customerID"];?> ~ <?php echo $user["customerUsername"];?></td>
                    <td><?php echo $order["orderDate"];?></td>
                    <td><?php echo $order["discount"];?></td>
                    <td><?php echo $order["orderStatus"];?></td>
                    </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

  <!-- Bootstrap core JavaScript -->
  <!-- <script src="/Hamzastore/vendor/jquery/jquery.min.js"></script> -->
  <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="js/dashboard.js"></script>

</body>

</html>


