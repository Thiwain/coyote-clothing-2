<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | eShop</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="logo.png" rel="icon">

</head>

<body>
    <?php
    session_start();

    require 'connection.php';

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


                    <div class="container-fluid">
                        <div class="row gy-3">


                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 text-center">
                                        <h2 class="h2 text-primary fw-bold">Add New Product</h2>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-4 border-end border-success">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Category</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="category">


                                                            <?php
                                                            $cat_rs = Database::search("SELECT * FROM `category`");

                                                            for ($x = 0; $x < $cat_rs->num_rows; $x++) {
                                                                $list_cat = $cat_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $list_cat['id']; ?>"><?php echo $list_cat['cat_name']; ?></option>
                                                            <?php
                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4 border-end border-success">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Item</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="item">


                                                            <?php
                                                            $cat_rs1 = Database::search("SELECT * FROM `item`");

                                                            for ($x = 0; $x < $cat_rs1->num_rows; $x++) {
                                                                $list_cat1 = $cat_rs1->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $list_cat1['id']; ?>"><?php echo $list_cat1['item_name']; ?></option>
                                                            <?php
                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                    <div class="col-8 mt-1">
                                                        <div class="row">
                                                            <input type="text" class="form-control col-9" placeholder="Add Item" id="itemInput" />
                                                            <button class="btn btn-primary col-3" onclick="itemInput();">+</button>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-2">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">List in home</label>
                                                    </div>




                                                    <div class="col-12 mb-2">
                                                        <select class="form-select text-center" id="homeList">


                                                            <?php
                                                            $cat_rs2 = Database::search("SELECT * FROM `home_listing`");

                                                            for ($x = 0; $x < $cat_rs2->num_rows; $x++) {
                                                                $list_cat2 = $cat_rs2->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $list_cat2['id']; ?>"><?php echo $list_cat2['list_class']; ?></option>
                                                            <?php
                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <hr class="border-success" />
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">
                                                            Add a Title to your Product
                                                        </label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <input type="text" class="form-control" id="title" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">
                                                            Price
                                                        </label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <input type="text" class="form-control" id="price" placeholder="LKR" />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea cols="30" rows="10" class="form-control" id="desc"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary mt-2 mb-2 offset-1" onclick="AddProduct();">Add Product</button>

                                            <div class="col-12">
                                                <hr class="border-success" />
                                            </div>

                                            <div class="col-12 d-none" id="varientBox">
                                                <div class="row">

                                                    <div class="col-12 col-lg-4 border-end border-success" id="">
                                                        <div class="row">

                                                            <div class="col-12">
                                                                <label class="form-label fw-bold" style="font-size: 20px;">Varient Title</label>
                                                            </div>


                                                            <div class="col-12 mt-2 mb-2">

                                                                <select class="form-select text-center" id="varientTitle">
                                                                    <?php
                                                                    $varient_titele_rs = Database::search("SELECT * FROM varient_title");

                                                                    for ($x = 0; $x < $varient_titele_rs->num_rows; $x++) {
                                                                        $list_varient_titele = $varient_titele_rs->fetch_assoc();
                                                                    ?>

                                                                        <option value="<?php echo $list_varient_titele['id']; ?>"><?php echo $list_varient_titele['vname']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                                </div>
                                                <div class="col-12">

                                                    <?php

                                                    ?>

                                                    <div class="row">
                                                        <input type="text" class="form-control col-3" id="vName" placeholder="Varient Name" />
                                                        <input type="number" class="form-control col-7" value="0" min="0" id="vQty" />
                                                        <button class="btn btn-outline-primary" onclick="addVarientFn();">Add</button>
                                                    </div>


                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="border-success" />
                            </div>


                            <div class="col-12">
                                <hr class="border-success" />
                            </div>


                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-4 border border-primary rounded">
                                                <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                                            </div>
                                            <div class="col-4 border border-primary rounded">
                                                <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                                            </div>
                                            <div class="col-4 border border-primary rounded">
                                                <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                        <input type="file" class="d-none" multiple id="imageuploader" />
                                        <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="border-success" />
                            </div>



                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                <button class="btn btn-success" onclick="addProductProcess();">Save Product</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>




        <?php
    } else {
        echo "puka";
    }
        ?>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>