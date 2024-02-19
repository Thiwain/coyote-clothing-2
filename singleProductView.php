<!DOCTYPE html>
<html lang="en">
<?php
require 'connection.php';

$pid = $_GET['id'];

$product_search_q = "SELECT * FROM `product` WHERE `id`='$pid'";
$product_rs = Database::search($product_search_q);
$pdata1 = $product_rs->fetch_assoc();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Coyote | <?php echo htmlspecialchars($pdata1['product_title']); ?></title>

    <link href="resources/logo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>
    <?php include "header.php" ?>

    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>

                <?php
                $main_img_q = "SELECT * FROM product_sub_images WHERE `product_id`='$pid'";
                $main_img_rs = Database::search($main_img_q);

                $main_img_rs2 = Database::search($main_img_q);
                $main_img_data2 = $main_img_rs2->fetch_assoc();
                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="row justify-content-center align-items-center mt-4">
                            <img src="<?php echo $main_img_data2['img_path']; ?>" class="col-12 col-lg-8 border border-1 border-dark rounded rounded-5" style="height: 520px; margin: 1px; center/cover no-repeat;" id="mainImgPrdt" />
                        </div>

                        <div class="row justify-content-center align-items-center mb-4 gap-3">

                            <?php
                            for ($z = 0; $z < $main_img_rs->num_rows; $z++) {
                                $main_img_data = $main_img_rs->fetch_assoc();
                            ?>
                                <div id="<?php echo 'pimg' . $z; ?>" class="col-3 col-lg-2 bg-danger border border-1 border-dark rounded rounded-5 thmbImg" style="margin: 0px; height: 160px; background: url('<?php echo $main_img_data['img_path']; ?>') center/cover no-repeat;" onclick="chngImg(event,'<?php echo $main_img_data['img_path']; ?>');"></div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4><?php echo htmlspecialchars($pdata1['product_title']); ?></h4>
                            <h3><?php echo htmlspecialchars($pdata1['price']); ?> LKR</h3>
                            <p><?php echo htmlspecialchars($pdata1['description']); ?></p>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <?php
                                    $varients_q = "SELECT * FROM `varient` WHERE `product_id`='$pid'";
                                    $varients_rs = Database::search($varients_q);
                                    $varients_boolean = true;
                                    $varients_active_sate;

                                    for ($x = 0; $x < $varients_rs->num_rows; $x++) {
                                        $list_varients = $varients_rs->fetch_assoc();
                                        $varients_active_sate = $varients_boolean ? "active" : null;
                                        $varients_boolean = false;
                                    ?>
                                        <label class="<?php echo htmlspecialchars($varients_active_sate); ?>" for="<?php echo htmlspecialchars($list_varients['vname']); ?>"><?php echo htmlspecialchars($list_varients['vname']); ?>
                                            <input type="radio" id="<?php echo htmlspecialchars($list_varients['id']); ?>">
                                        </label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="product__details__cart__option mt-3">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" id="prdQty" />
                                        </div>
                                    </div>
                                    <a href="#" id="addToCartSp" onclick="addtoCartSp(event, <?php echo htmlspecialchars($pid); ?>);" class="primary-btn">add to cart</a>
                                </div>
                                <div class="product__details__last__option">
                                    <h5><span>Guaranteed Safe Checkout</span></h5>
                                    <img src="img/shop-details/details-payment.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "footer.php" ?>


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
</body>

</html>