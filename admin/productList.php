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

                            <div class="container-fluid">

                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Products.</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                        <th>#</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                        <th>#</th>
                                                        <th>#</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>

                                                    <?php

                                                    $result = Database::search("SELECT * FROM product");


                                                    if ($result->num_rows > 0) {
                                                        // Output the details of each order found
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['product_title']; ?></td>
                                                                <td><?php echo $row['description']; ?></td>
                                                                <td><?php echo $row['price']; ?></td>
                                                                <td><button class="btn btn-outline-dark" onclick="deleteProduct(<?php echo $row['id']; ?>);">🗑️</button></td>
                                                                <td><button class="btn btn-outline-dark">✏️Edit</button></td>
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