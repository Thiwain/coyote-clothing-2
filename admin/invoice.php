<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coyote Clothing | Invoice</title>

    <link href="logo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>

    <?php
    session_start();
    require 'connection.php';

    $in_id = $_GET['id'];

    if (isset($_SESSION['au'])) {



    ?>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php include 'sidebar.php'; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- nav -->
                    <?php include 'nav.php'; ?>
                    <!-- nav -->

                    <div class="container mt-5 mb-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <h4 class="float-end font-size-15">Invoice #<?php echo $in_id; ?> <span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                                            <div class="mb-4">
                                                <h2 class="mb-1 text-muted">coyote-clothing.com</h2>
                                            </div>
                                            <div class="text-muted">

                                                <?php
                                                $main_res = Database::search("SELECT *
                                    FROM coyote_clothing.invoice AS inv
                                    INNER JOIN coyote_clothing.shipping_related AS shipping ON inv.id = shipping.invoice_id
                                    INNER JOIN coyote_clothing.shipping_charge AS charge ON inv.shipping_charge_id = charge.id
                                    INNER JOIN coyote_clothing.user AS usr ON inv.user_id = usr.id
                                    WHERE inv.id = '$in_id';                                    
                                ");
                                                $main_res_fetch = $main_res->fetch_assoc();
                                                ?>

                                                <p class="mb-1">3184 Spruce Drive Pittsburgh, PA 15201</p>
                                                <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>coyoteclo@company.com</p>
                                                <p><i class="uil uil-phone me-1"></i> 011-345-6789</p>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-muted">
                                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                                    <h5 class="font-size-15 mb-2">Preston Miller</h5>
                                                    <p class="mb-1"><?php echo $main_res_fetch['address']; ?></p>
                                                    <p class="mb-1"><?php echo $main_res_fetch['email'] ?></p>
                                                    <p><?php echo $main_res_fetch['mobile'] ?></p>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="text-muted text-sm-end">
                                                    <div>
                                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                                        <p>#<?php echo $in_id; ?></p>
                                                    </div>
                                                    <div class="mt-4">
                                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                                        <p><?php echo $main_res_fetch['datetime']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="py-2">
                                            <h5 class="font-size-15">Order Summary</h5>

                                            <div class="table-responsive">
                                                <table class="table align-middle table-nowrap table-centered mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 70px;">No.</th>
                                                            <th>Item</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th class="text-end" style="width: 120px;">Total</th>
                                                        </tr>
                                                    </thead><!-- end thead -->
                                                    <tbody>
                                                        <?php
                                                        $bill_row_rs = Database::search("SELECT 
                                            invoice_item.invoice_id,
                                            invoice_item.product_id AS invoice_item_product_id,
                                            invoice_item.varient_id AS invoice_item_varient_id,
                                            invoice_item.qty AS invoice_item_qty,
                                            varient.id AS varient_id,
                                            varient.product_id AS varient_product_id,
                                            varient.vname AS varient_vname,
                                            varient.qty AS varient_qty,
                                            varient.varient_title_id AS varient_varient_title_id,
                                            varient_title.id AS varient_title_id,
                                            varient_title.vname AS varient_title_vname,
                                            product.id AS product_id,
                                            product.product_title,
                                            product.description,
                                            product.item_id,
                                            product.home_listing_id,
                                            product.price
                                        FROM 
                                            coyote_clothing.invoice_item
                                        INNER JOIN 
                                            varient ON varient.id = invoice_item.varient_id
                                        INNER JOIN 
                                            varient_title ON varient_title.id = varient.varient_title_id
                                        INNER JOIN 
                                            product ON invoice_item.product_id = product.id
                                        WHERE 
                                            invoice_id = 4521609;
                                        ");

                                                        for ($i = 0; $i < $bill_row_rs->num_rows; $i++) {
                                                            $bill_fetch = $bill_row_rs->fetch_assoc();

                                                        ?>
                                                            <!-- row -->
                                                            <tr>
                                                                <th scope="row"><?php echo $i; ?></th>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-truncate font-size-14 mb-1"><?php echo $bill_fetch['product_title']; ?></h5>
                                                                        <p class="text-muted mb-0"><?php echo $bill_fetch['varient_title_vname']; ?>: <?php echo $bill_fetch['varient_vname']; ?></p>
                                                                    </div>
                                                                </td>
                                                                <td>LKR <?php echo $bill_fetch['price']; ?></td>
                                                                <td><?php echo $bill_fetch['invoice_item_qty']; ?></td>
                                                                <td class="text-end">LKR <?php echo $bill_fetch['price'] * $bill_fetch['invoice_item_qty']; ?></td>
                                                            </tr>
                                                            <!-- row -->
                                                        <?php
                                                        }
                                                        ?>

                                                        <tr>
                                                            <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                                            <td class="text-end">LKR <?php echo $main_res_fetch['total']; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                                Shipping Charge :</th>
                                                            <td class="border-0 text-end">LKR 200</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                            <td class="border-0 text-end">
                                                                <h4 class="m-0 fw-semibold">LKR <?php echo $main_res_fetch['total'] + 200; ?></h4>
                                                            </td>
                                                        </tr>
                                                        <!-- end tr -->
                                                    </tbody><!-- end tbody -->
                                                </table><!-- end table -->
                                            </div><!-- end table responsive -->
                                            <div class="d-print-none mt-4">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                                </div>
                                                <div class="float-end mt-2">
                                                    <?php
                                                    if ($main_res_fetch['order_sts_id'] == '2') {

                                                    ?>
                                                        <button href="" class="btn btn-success me-1" onclick="fulfillOrder('<?php echo $in_id = $_GET['id']; ?>');">fulfill Order</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button href="" class="btn btn-danger me-1" onclick="">Order Fulfilled</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <script>
            window.location = "index.php";
        </script>
    <?php
    }
    ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main2.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/ajax.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>