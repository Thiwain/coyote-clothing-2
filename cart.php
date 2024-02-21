<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="resources/logo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>
    <?php include 'header.php';
    require 'connection.php';

    if (isset($_SESSION['u'])) {
    ?>

        <div class="mt-1 mb-1">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">

                                <div class="row">

                                    <div class="col-lg-7">
                                        <h5 class="mb-3"><a href="index.php" class="text-body">🔙 Continue shopping</a></h5>
                                        <hr>

                                        <?php
                                        $uid = $_SESSION['u']['id'];

                                        $cart_s_q = "SELECT 
                                        `cart`.*, 
                                        `product_img`.`path` AS `product_img_url`, 
                                        `product`.`product_title` AS `product_name`, 
                                        `product`.`description` AS `product_description`, 
                                        `product`.`price` AS `product_price`, 
                                        `varient`.`vname` AS `varient_name` 
                                    FROM 
                                        `cart` 
                                    INNER JOIN 
                                        `product_img` ON `product_img`.`product_id` = `cart`.`product_id` 
                                    INNER JOIN 
                                        `product` ON `product`.`id` = `cart`.`product_id` 
                                    INNER JOIN 
                                        `varient` ON `varient`.`id` = `cart`.`varient_id` 
                                    WHERE 
                                        `cart`.`user_id` = '1';
                                    ";
                                        $cart_res = Database::search($cart_s_q);
                                        ?>
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <p class="mb-1">Shopping cart</p>
                                                <p class="mb-0">You have <?php echo $cart_res->num_rows; ?> items in your cart</p>
                                            </div>
                                            <div>
                                                <!-- <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price 🔽</a></p> -->
                                            </div>
                                        </div>

                                        <?php
                                        for ($z = 0; $z < $cart_res->num_rows; $z++) {
                                            $cart_fetch = $cart_res->fetch_assoc();
                                        ?>
                                            <!-- item -->
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div>
                                                                <img src="<?php echo $cart_fetch['product_img_url']; ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                            </div>
                                                            <div class="m-3">
                                                                <h5><?php echo $cart_fetch['product_name']; ?></h5>
                                                                <p class="small mb-0"><?php echo $cart_fetch['varient_name']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div style="width: 50px;">
                                                                <h5 class="fw-normal mb-0">
                                                                    <p>qty</p><?php echo $cart_fetch['qty']; ?>
                                                                </h5>
                                                            </div>
                                                            <div style="width: 80px;">
                                                                <h5 class="mb-0"><?php echo $cart_fetch['product_price'] . 'LKR'; ?></h5>
                                                            </div>
                                                            <button class="btn btn-outline-light" onclick="cartDel(event,<?php echo $cart_fetch['cart_id']; ?>);" style="color: #cecece;">🗑️</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- item -->
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-5">

                                        <div class="card bg-primary text-white rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h5 class="mb-0">Details</h5>
                                                </div>

                                                <form class="mt-4">
                                                    <div class="form-outline form-white mb-4">
                                                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Reciver's Name" name="rname" />
                                                        <label class="form-label" for="typeName">Reciver's Name</label>
                                                    </div>

                                                    <div class="form-outline form-white mb-4">
                                                        <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="Mobile No." minlength="19" maxlength="19" name="rno" />
                                                        <label class="form-label" for="typeText">Mobile Number</label>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <div class="form-outline form-white">
                                                                <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="Address" size="7" id="exp" minlength="7" maxlength="7" name="Address" />
                                                                <label class="form-label" for="typeExp">Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-outline form-white">
                                                                <input type="email" id="typeText" class="form-control form-control-lg" placeholder="email" size="1" minlength="3" maxlength="3" />
                                                                <label class="form-label" for="typeText">Email</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>

                                                <hr class="my-4">

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Subtotal</p>
                                                    <p class="mb-2">$4798.00</p>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Shipping</p>
                                                    <p class="mb-2">$20.00</p>
                                                </div>

                                                <div class="d-flex justify-content-between mb-4">
                                                    <p class="mb-2">Total(Incl. taxes)</p>
                                                    <p class="mb-2">$4818.00</p>
                                                </div>

                                                <button type="button" class="btn btn-dark btn-block btn-lg">
                                                    <div class="d-flex justify-content-between">
                                                        <span>$4818.00</span>
                                                        <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>

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
    ?>
        <script>
            window.location.href = "account.php";
        </script>
    <?php
    }
    ?>

    <?php include 'footer.php' ?>

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
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>