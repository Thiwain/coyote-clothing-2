<!DOCTYPE html>
<html lang="en">
<?php require 'connection.php'; ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

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

                                        // Output the top trending product ID
                                        echo "Top trending product ID: $trendingProductId";
                                    } else {
                                        echo "No trending products found.";
                                    }
                                    ?>

                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Accordion -->
                                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 class="m-0 font-weight-bold text-primary">Collapsable Card Example</h6>
                                        </a>
                                        <!-- Card Content - Collapse -->
                                        <div class="collapse show" id="collapseCardExample" style="">
                                            <div class="card-body">
                                                This is a collapsable card example using Bootstrap's built in collapse
                                                functionality. <strong>Click on the card header</strong> to see the card body
                                                collapse and expand!
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
                                        echo "Most sold product ID: $mostSoldProductId";
                                    } else {
                                        echo "No products found.";
                                    }
                                    ?>

                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Accordion -->
                                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 class="m-0 font-weight-bold text-primary">Collapsable Card Example</h6>
                                        </a>
                                        <!-- Card Content - Collapse -->
                                        <div class="collapse show" id="collapseCardExample" style="">
                                            <div class="card-body">
                                                This is a collapsable card example using Bootstrap's built in collapse
                                                functionality. <strong>Click on the card header</strong> to see the card body
                                                collapse and expand!
                                            </div>
                                        </div>
                                    </div>

                                    

                                </div>
                            </div>
                        </div>

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
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                </tr>
                                                <tr>
                                                    <td>Garrett Winters</td>
                                                    <td>Accountant</td>
                                                    <td>Tokyo</td>
                                                    <td>63</td>
                                                    <td>2011/07/25</td>
                                                    <td>$170,750</td>
                                                </tr>
                                                <tr>
                                                    <td>Ashton Cox</td>
                                                    <td>Junior Technical Author</td>
                                                    <td>San Francisco</td>
                                                    <td>66</td>
                                                    <td>2009/01/12</td>
                                                    <td>$86,000</td>
                                                </tr>
                                                <tr>
                                                    <td>Cedric Kelly</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>Edinburgh</td>
                                                    <td>22</td>
                                                    <td>2012/03/29</td>
                                                    <td>$433,060</td>
                                                </tr>
                                                <tr>
                                                    <td>Airi Satou</td>
                                                    <td>Accountant</td>
                                                    <td>Tokyo</td>
                                                    <td>33</td>
                                                    <td>2008/11/28</td>
                                                    <td>$162,700</td>
                                                </tr>
                                                <tr>
                                                    <td>Brielle Williamson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>New York</td>
                                                    <td>61</td>
                                                    <td>2012/12/02</td>
                                                    <td>$372,000</td>
                                                </tr>
                                                <tr>
                                                    <td>Herrod Chandler</td>
                                                    <td>Sales Assistant</td>
                                                    <td>San Francisco</td>
                                                    <td>59</td>
                                                    <td>2012/08/06</td>
                                                    <td>$137,500</td>
                                                </tr>
                                                <tr>
                                                    <td>Rhona Davidson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>Tokyo</td>
                                                    <td>55</td>
                                                    <td>2010/10/14</td>
                                                    <td>$327,900</td>
                                                </tr>
                                                <tr>
                                                    <td>Colleen Hurst</td>
                                                    <td>Javascript Developer</td>
                                                    <td>San Francisco</td>
                                                    <td>39</td>
                                                    <td>2009/09/15</td>
                                                    <td>$205,500</td>
                                                </tr>
                                                <tr>
                                                    <td>Sonya Frost</td>
                                                    <td>Software Engineer</td>
                                                    <td>Edinburgh</td>
                                                    <td>23</td>
                                                    <td>2008/12/13</td>
                                                    <td>$103,600</td>
                                                </tr>
                                                <tr>
                                                    <td>Jena Gaines</td>
                                                    <td>Office Manager</td>
                                                    <td>London</td>
                                                    <td>30</td>
                                                    <td>2008/12/19</td>
                                                    <td>$90,560</td>
                                                </tr>
                                                <tr>
                                                    <td>Quinn Flynn</td>
                                                    <td>Support Lead</td>
                                                    <td>Edinburgh</td>
                                                    <td>22</td>
                                                    <td>2013/03/03</td>
                                                    <td>$342,000</td>
                                                </tr>
                                                <tr>
                                                    <td>Charde Marshall</td>
                                                    <td>Regional Director</td>
                                                    <td>San Francisco</td>
                                                    <td>36</td>
                                                    <td>2008/10/16</td>
                                                    <td>$470,600</td>
                                                </tr>
                                                <tr>
                                                    <td>Haley Kennedy</td>
                                                    <td>Senior Marketing Designer</td>
                                                    <td>London</td>
                                                    <td>43</td>
                                                    <td>2012/12/18</td>
                                                    <td>$313,500</td>
                                                </tr>

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