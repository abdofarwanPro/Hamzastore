<?php  

require_once 'includes/db.php';
require_once 'includes/resources.php';
require_once ("includes/auth_session.php");
$sessionUser = $_SESSION['sessionId'];

// get ?orderid=# from get request
if(isset($_GET['orderid'])){
    $orderid = htmlentities(strip_tags($_GET['orderid']));
        // get order info
        $order_query = viewOrderByID($con, $orderid);
        $order = $order_query -> fetch_array();
    if ($sessionUser == $order["customerID"]) {
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
} else {
    header("Location: customer.php?error=accessdenied");
}
}
?> 
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="css/view.css" rel="stylesheet" />
<div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #<?php echo $order["orderID"];?>
            </small>
        </h1>

        <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" href="javascript:history.back()" data-title="Print">
                    <i class="mr-1 fas fa-arrow-left text-primary-m1 text-120 w-2"></i>
                    Go back
                </a>
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <i class="fas fa-head-side-mask fa-2x text-success-m2 mr-1"></i>
                            <span class="text-default-d3">HamzaStore.com</span>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle"><?php echo $user["customerUsername"];?> # <?php echo $user["customerID"];?></span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                            <b>Customer Location:</b> <?php echo $user["customerAddress"];?>
                            </div>
                            <div>
                            <span class="text-sm text-grey-m2 align-middle">Vendor:</span>
                            <span class="text-600 text-110 text-blue align-middle"><?php echo $vendor["vendorname"];?> #<?php echo $vendor["vendorID"];?> </span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                               <b>Vendor Location:</b> <?php echo $vendor["address"];?>
                            </div>
                        </div>
                            <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600"><?php echo $vendor["phone"];?></b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #<?php echo $order["orderID"];?></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> <?php echo $order["orderDate"];?></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25"><?php echo $order["orderStatus"];?></span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Product Name</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                        <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                        <div class="col-2">Amount</div>
                    </div>

                    <div class="text-95 text-secondary-d3">
                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-1">1</div>
                            <div class="col-9 col-sm-5"><?php echo $product["facemaskName"];?></div>
                            <div class="d-none d-sm-block col-2"><?php echo $order["quantity"];?></div>
                            <div class="d-none d-sm-block col-2 text-95">$<?php echo $product["facemaskPrice"];?></div>
                            <div class="col-2 text-secondary-d2">$<?php echo $order["quantity"]*$product["facemaskPrice"];?></div>
                        </div>
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    <!--
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <tr>
                            <td>1</td>
                            <td>Domain registration</td>
                            <td>2</td>
                            <td class="text-95">$10</td>
                            <td class="text-secondary-d2">$20</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            -->

                    <div class="row mt-3">
                
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                        <img src="<?php echo $product["facemaskImg"];?>" class="rounded float-left img-thumbnail" style="max-height: 70px; max-width: 70px;" alt="...">
                            <br>Ordered Product Image for refrence
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    SubTotal
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1">$<?php echo $order["quantity"]*$product["facemaskPrice"];?></span>
                                </div>
                            </div>
                            <?php if ($order["discount"] == "true") { ?>
                            
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Discount (10%)
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1">$<?php echo $order["quantity"]*$product["facemaskPrice"]-$order["orderTotal"];?></span>
                                </div>
                            </div>
                            <?php }?>
                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2">$<?php echo $order["orderTotal"];?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        <?php if ($order["orderStatus"] == "Unpaid") { ?>
                        <a href="includes/orderstatus.inc.php?orderid=<?php echo $order["orderID"];?>" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


