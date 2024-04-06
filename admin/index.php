<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require 'connection.php'; ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>
    <link href="logo.png" rel="icon">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php

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

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <?php

                            $monthquery = "SELECT MONTH(datetime) AS month, YEAR(datetime) AS year, SUM(total) AS monthly_earnings
          FROM coyote_clothing.invoice
          GROUP BY YEAR(datetime), MONTH(datetime)
          ORDER BY YEAR(datetime) DESC, MONTH(datetime) DESC";

                            $result = Database::search($monthquery);

                            // Initialize an array to store monthly earnings
                            $monthlyEarnings = array();

                            // Loop through the result set and store the earnings for each month
                            while ($row = mysqli_fetch_assoc($result)) {
                                $year = $row['year'];
                                $month = $row['month'];
                                $earnings = $row['monthly_earnings'];

                                // Store earnings for the corresponding month and year
                                $monthlyEarnings["$year-$month"] = $earnings;
                            }

                            // Output monthly earnings
                            foreach ($monthlyEarnings as $date => $earnings) {
                                list($year, $month) = explode('-', $date);
                            }

                            // Calculate total earnings for all months
                            $totalEarnings = array_sum($monthlyEarnings);


                            // Yearly

                            // Define the query for annual earnings
                            $annualQuery = "SELECT YEAR(datetime) AS year, SUM(total) AS annual_earnings
                FROM coyote_clothing.invoice
                GROUP BY YEAR(datetime)
                ORDER BY YEAR(datetime) DESC";

                            // Execute the query using the Database class
                            $result = Database::search($annualQuery);

                            // Initialize an array to store annual earnings
                            $annualEarnings = array();

                            // Loop through the result set and store the earnings for each year
                            while ($row = $result->fetch_assoc()) {
                                $year = $row['year'];
                                $earnings = $row['annual_earnings'];

                                // Store earnings for the corresponding year
                                $annualEarnings[$year] = $earnings;
                            }

                            // Output annual earnings
                            foreach ($annualEarnings as $year => $earnings) {
                            }

                            // Calculate total earnings for all years
                            $totalEarnings = array_sum($annualEarnings);

                            // current week



                            ?>


                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Earnings (Monthly) <?php echo "$year-$month: $earnings"; ?></div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">LKR <?php echo $totalEarnings; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Earnings (Annual) <?php echo $year; ?> </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">LKR <?php echo $totalEarnings; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <?php
                            $totalEarnsRs = Database::search("SELECT SUM(total) AS total_earnings
                          FROM invoice
                          ");

                            $fetched_total_earn = $totalEarnsRs->fetch_assoc();

                            $fetched_total_earn['total_earnings'];
                            ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Earnings </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">LKR <?php echo $fetched_total_earn['total_earnings']; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-10 offset-1 mt-2 mb-2">
                                        <?php
                                        // Define the query to get the top trending product ID
                                        $trendingProductQuery = "SELECT product_id, SUM(qty) AS total_quantity_sold
                         FROM coyote_clothing.invoice_item
                         GROUP BY product_id
                         ORDER BY total_quantity_sold DESC
                         LIMIT 1";

                                        // Execute the query using the Database class
                                        $result = Database::search($trendingProductQuery);

                                        // Fetch the top trending product ID
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $trendingProductId = $row['product_id'];
                                        } else {
                                            echo "No trending products found.";
                                        }

                                        $trending_prd_search_rs = Database::search("SELECT 
                                    p.id AS product_id,
                                    p.product_title,
                                    p.description,
                                    p.price,
                                    i.item_name,
                                    pi.path AS product_image_path
                                FROM 
                                    product p
                                INNER JOIN 
                                    item i ON p.item_id = i.id
                                INNER JOIN 
                                    product_img pi ON p.id = pi.product_id
                                WHERE 
                                    p.id = '$trendingProductId';
                                ");

                                        $trending_rs = $trending_prd_search_rs->fetch_assoc();

                                        ?>

                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Accordion -->
                                            <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="1">
                                                <h6 class="m-0 font-weight-bold text-primary">Trending: <?php echo $trending_rs['product_title']; ?></h6>
                                            </a>

                                            <!-- Card Content - Collapse -->
                                            <div class="collapse show" id="collapseCardExample1" style="">
                                                <div class="card-body">

                                                    <img src="../<?php echo $trending_rs['product_image_path']; ?>" style="" class="col-2" alt="sad">
                                                    <br>
                                                    <br>
                                                    <h6 class="">Price LKR <b><?php echo $trending_rs['price']; ?></b></h6>
                                                    <br>
                                                    <?php echo $trending_rs['description']; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        // Define the query to get the most sold product
                                        $mostSoldProductQuery = "SELECT product_id, SUM(qty) AS total_quantity_sold
                         FROM coyote_clothing.invoice_item
                         GROUP BY product_id
                         ORDER BY total_quantity_sold DESC
                         LIMIT 1";

                                        // Execute the query using the Database class
                                        $result = Database::search($mostSoldProductQuery);

                                        // Fetch the most sold product
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $mostSoldProductId = $row['product_id'];

                                            // Output the most sold product ID
                                        } else {
                                            echo "No products found.";
                                        }


                                        $most_sold_prd_search_rs = Database::search("SELECT 
                                    p.id AS product_id,
                                    p.product_title,
                                    p.description,
                                    p.price,
                                    i.item_name,
                                    pi.path AS product_image_path
                                FROM 
                                    product p
                                INNER JOIN 
                                    item i ON p.item_id = i.id
                                INNER JOIN 
                                    product_img pi ON p.id = pi.product_id
                                WHERE 
                                    p.id = '$mostSoldProductId';
                                ");

                                        $most_sold_rs = $most_sold_prd_search_rs->fetch_assoc();

                                        ?>

                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Accordion -->
                                            <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                <h6 class="m-0 font-weight-bold text-primary">Most Sold: <?php echo $most_sold_rs['product_title']; ?></h6>
                                            </a>
                                            <div class="collapse show" id="collapseCardExample2" style="">
                                                <div class="card-body">
                                                    <img src="../<?php echo $most_sold_rs['product_image_path']; ?>" style="" class="col-2" alt="sad">
                                                    <br>
                                                    <br>
                                                    <h6 class="">Price LKR <b><?php echo $most_sold_rs['price']; ?></b></h6>
                                                    <br>
                                                    <?php echo $most_sold_rs['description']; ?>

                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>

                            <?php

                            $searchOrdersQuery = "SELECT * FROM invoice INNER JOIN shipping_related ON shipping_related.invoice_id=invoice.id INNER JOIN user ON user.id=invoice.user_id WHERE order_sts_id=2";



                            ?>


                            <!-- Begin Page Content -->
                            <div class="container-fluid">

                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Unfulfilled Orders.</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>OrderBy</th>
                                                        <th>Reciver</th>
                                                        <th>DateTime</th>
                                                        <th>Address</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>OrderBy</th>
                                                        <th>Reciver</th>
                                                        <th>DateTime</th>
                                                        <th>Address</th>
                                                        <th>#</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>

                                                    <?php


                                                    $result = Database::search($searchOrdersQuery);

                                                    if ($result->num_rows > 0) {
                                                        // Output the details of each order found
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $row['invoice_id']; ?></td>
                                                                <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
                                                                <td><?php echo $row['r_name']; ?></td>
                                                                <td><?php echo $row['datetime']; ?></td>
                                                                <td><?php echo $row['address']; ?></td>
                                                                <td><button class="btn btn-outline-dark" onclick="orderInfo('<?php echo $row['invoice_id']; ?>');">📖</button></td>
                                                            </tr>
                                                    <?php

                                                        }
                                                    } else {
                                                        echo "No orders found with order status ID $orderStatusID.";
                                                    }

                                                    ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->




                        <div class="row">
                            <!-- Content Column -->
                            <div class="col-lg-10 mb-4">



                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include 'footer.php'; ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    <?php
    } else {
    ?>
        <div class="" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Admin Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" id="adminPwModal">
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label class="label" for="name">Type your email to get veification code</label>
                                <p class="text-danger" id="fpwMoadlWrn"></p>
                                <div class="row">
                                    <div class="col-10 offset-1">
                                        <div class="row gap-2">
                                            <input type="text" class="form-control col-9" placeholder="Email" required name="email" />
                                            <button type="button" class="btn btn-primary col-2 offset-1" id="sendVcode" onclick="sendVcodefn();">Send</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-10 offset-1">
                                        <div class="row gap-2">
                                            <input type="text" class="form-control col-12" placeholder="Code" required name="vcode" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="adminHome();">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="script.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>