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
                                                        <select class="form-select text-center" id="brand">


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
                                                        <input type="text" class="form-control" id="itemInput" />
                                                        <button class="btn btn-primary mt-1" onclick="itemInput();">+</button>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4 border-end border-success">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="model">
                                                            <option value="0">Select Model</option>

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
                                                <hr class="border-success" />
                                            </div>

                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="col-12 col-lg-4 border-end border-success">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check form-check-inline mx-5">
                                                                    <input class="form-check-input" type="radio" name="c" id="b" checked />
                                                                    <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="c" id="u" />
                                                                    <label class="form-check-label fw-bold" for="u">Used</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-lg-4 border-end border-success">
                                                        <div class="row">

                                                            <div class="col-12">
                                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                                            </div>

                                                            <div class="col-12">

                                                                <select class="col-12 form-select" id="clr">
                                                                    <option value="0">Select Colour</option>

                                                                </select>

                                                            </div>

                                                            <div class="col-12">
                                                                <div class="input-group mt-2 mb-2">
                                                                    <input type="text" class="form-control" placeholder="Add new Colour" />
                                                                    <button class="btn btn-outline-primary" type="button">+ Add</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-lg-4">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <input type="number" class="form-control" value="0" min="0" id="qty" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <hr class="border-success" />
                                            </div>

                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="col-6 border-end border-success">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                            </div>
                                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                                <div class="input-group mb-2 mt-2">
                                                                    <span class="input-group-text">Rs.</span>
                                                                    <input type="text" class="form-control" id="cost" />
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                                    <div class="col-2 pm pm2"></div>
                                                                    <div class="col-2 pm pm3"></div>
                                                                    <div class="col-2 pm pm4"></div>
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
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                                    </div>
                                                    <div class="col-12 col-lg-6 border-end border-success">
                                                        <div class="row">
                                                            <div class="col-12 offset-lg-1 col-lg-3">
                                                                <label class="form-label">Delivery cost Within Colombo</label>
                                                            </div>
                                                            <div class="col-12 col-lg-8">
                                                                <div class="input-group mb-2 mt-2">
                                                                    <span class="input-group-text">Rs.</span>
                                                                    <input type="text" class="form-control" id="dwc" />
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="col-12 offset-lg-1 col-lg-3">
                                                                <label class="form-label">Delivery cost out of Colombo</label>
                                                            </div>
                                                            <div class="col-12 col-lg-8">
                                                                <div class="input-group mb-2 mt-2">
                                                                    <span class="input-group-text">Rs.</span>
                                                                    <input type="text" class="form-control" id="doc" />
                                                                    <span class="input-group-text">.00</span>
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
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea cols="30" rows="15" class="form-control" id="desc"></textarea>
                                                    </div>
                                                </div>
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

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Notice...</label><br />
                                                <label class="form-label">
                                                    We are taking 5% of the product from price from every
                                                    product as a service charge.
                                                </label>
                                            </div>

                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                                <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

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