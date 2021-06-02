<?php include("../includes/db.php"); include("../includes/auth_session.php"); require_once '../includes/resources.php'; 


// check if username is admin
if($_SESSION['username'] !== 'admin'){
  // isn't admin, redirect them to a different page
  header("Location: /Hamzastore/login.php");
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
  <link href="vendor/bootstrap/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a class="nav-link" href="orders.php">
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
            <a class="nav-link active" href="addproduct.php">
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

      <h2>Add Facemask</h2>
      <form class="row g-3" action="includes/addproduct.inc.php" method="POST">
  <div class="col-md-6">
    <label for="facemaskName" class="form-label">Facemask Name</label>
    <input type="text" class="form-control" id="facemaskName" placeholder="Nice Mask" name="facemaskName">
  </div>
  <div class="col-md-6">
    <label for="facemaskPrice" class="form-label">Price</label>
    <input type="text" class="form-control" id="facemaskPrice" placeholder="$145" name="facemaskPrice">
  </div>
  <div class="col-12">
    <label for="facemaskDescription" class="form-label">Description</label>
    <input type="text" class="form-control" id="facemaskDescription" placeholder="A very nice mask...." name="facemaskDescription">
  </div>
  <div class="col-md-6">
    <label for="facemaskImg" class="form-label">Image URL</label>
    <input type="text" class="form-control" id="facemaskImg" placeholder="Image URL" name="facemaskImg">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Vendor</label>
    <select id="inputState" class="form-select" name="vendorID">
      <option selected>Choose...</option>
      <?php 
                $query = viewAllVendors($con);
                $count = 0;
                while ($vendor = $query -> fetch_array()) {
                    # code...
                    $count +=1;
                    ?>
                <option value="<?php echo $vendor["vendorID"];?>"><?php echo $vendor["vendorname"];?></option>
            <?php
                }
            ?>
    </select>
  </div>
  <div class="col-md-2">
    <label for="facemaskQuantity" class="form-label">Quantity Available</label>
    <input type="text" class="form-control" id="facemaskQuantity" placeholder="17" name="facemaskQuantity">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Add Facemask</button>
  </div>
</form>
      </div>
    </main>
  </div>
</div>

  <!-- Bootstrap core JavaScript -->
  <!-- <script src="/Hamzastore/vendor/jquery/jquery.min.js"></script> -->
  <script src="vendor/bootstrap/5.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="vendor/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="js/dashboard.js"></script>

</body>

</html>


