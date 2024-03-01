<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coyote | Home</title>
    <link href="resources/logo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>

    <?php include "header.php"; ?>
    <?php require 'connection.php'; ?>

    <!-- Add search form -->
    <input type="text" id="searchInput" placeholder="Search products">
    <button onclick="searchProducts()">Search</button>

    <!-- Add sorting options -->
    <select id="sortBy">
        <option value="product_title">Product Title</option>
        <option value="price">Price</option>
        <!-- Add more sorting options if needed -->
    </select>
    <select id="sortOrder">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
    </select>
    <button onclick="sortProducts()">Sort</button>

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row product__filter" id="productList">
                <!-- PHP code to fetch and display products -->
            </div>
        </div>
    </section>

    <?php include "footer.php"; ?>

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