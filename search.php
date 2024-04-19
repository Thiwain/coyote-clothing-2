<?php
if (isset($_GET['search_query'])) {
    $search = $_GET['search_query'];
} else {
    header("Location: index.php");
}

require_once 'connection.php';

// TODO: I only select the product details and home_listing details. Make sure that u link the product images.

$search_query = "
SELECT 
    product.id AS product_id,
    product.product_title,
    product.description AS product_description,
    product.price AS product_price,
    home_listing.id AS home_listing_id,
    home_listing.list_class
FROM
    product
INNER JOIN
    home_listing ON home_listing.id = product.home_listing_id
WHERE
    product.product_title LIKE '%$search%'
ORDER BY
    product.id ASC
";

$product_rs = Database::search($search_query);
$product_num = $product_rs->num_rows;

?>

<!doctype html>
<html lang="en">

<head>
    <title>Coyote | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="resources//logo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style2.css" type="text/css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include "header.php" ?>

    <!-- Product Result Begin -->
    <section class="product spad">
        <div class="container">
            <!-- Start search result counter -->
            <?php
            if ($product_num != 0) {
            ?>
                <div class="my-3">
                    <h5><?php echo $product_num ?> products found.</h5>
                </div>
            <?php
            }
            ?>
            <!-- End search result counter -->
            <!-- Loop the products from the database -->
            <div class="row product__filter">
                <?php
                if ($product_num != 0) {
                    for ($z = 0; $z < $product_num; $z++) {
                        $product_data = $product_rs->fetch_assoc();
                ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix <?php echo $product_data['list_class'] ?>">
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#" onclick="toSPV(<?php echo $product_data['product_id'] ?>);"><img src="img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?php echo $product_data['product_title'] ?></h6>
                                    <a href="#" class="add-cart" onclick="addToCartHome(<?php echo $product_data['product_id'] ?>,event);">+ Add To Cart</a>
                                    <div class="rating"></div>
                                    <h5><?php echo $product_data['product_price'] ?> LKR</h5>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <!-- Display a no result found message with a help search(change it) -->
                    <div class="my-5">
                        <!-- TODO: please replace the seach query with something else that exist in the database! -->
                        <h1>Sorry no results! Try for a <a href="search.php?search_query=red+tee">red tee</a> instead</h1>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <?php include "footer.php" ?>

    <!-- payhere lib -->
    <script type=" text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

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
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/script.js"></script>

</body>

</html>