<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coyote | Edit Profile</title>


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

    <?php include 'header.php';
    require "connection.php";
    ?>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <div class="row flex-lg-nowrap mt-4">

            <div class="col">
                <div class="row">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">

                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo ($_SESSION["u"]["fname"] . ' ' . $_SESSION["u"]["lname"]); ?></h4>
                                                <p class="mb-0"><?php echo ($_SESSION["u"]["email"]) ?></p>
                                                <div class="mt-2">
                                                </div>
                                            </div>
                                            <div class="text-center text-sm-right">
                                                <span class="badge badge-secondary">Customer</span>
                                                <div class="text-muted"><small><?php echo ($_SESSION["u"]["joined_date"]) ?></small></div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href class="active nav-link">Settings</a></li>
                                    </ul>
                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input class="form-control" type="text" name="name" placeholder="John Smith" value="<?php echo $_SESSION["u"]["fname"] ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input class="form-control" type="text" name="username" placeholder="johnny.s" value="<?php echo $_SESSION["u"]["lname"] ?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form id="saveProfileChangesForm">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input class="form-control" type="text" value="<?php echo $_SESSION["u"]["email"] ?>" name="curemail">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Gender</label>
                                                                    <?php
                                                                    $rs = Database::search("SELECT * FROM `gender` WHERE `id`='" . $_SESSION["u"]["gender_id"] . "'");
                                                                    $d = $rs->fetch_assoc();
                                                                    ?>
                                                                    <input class="form-control" type="text" value="<?php echo $d['gender_name'] ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <div class="form-group">
                                                                    <label>Address</label>
                                                                    <?php
                                                                    $rs2 = Database::search("SELECT * FROM `user_address` WHERE `user_id`='" . $_SESSION["u"]["id"] . "'");
                                                                    ?>
                                                                    <textarea name="address" class="form-control" rows="5" placeholder="Your Address"><?php
                                                                                                                                                        if ($rs2->num_rows != 0) {
                                                                                                                                                            $d2 = $rs2->fetch_assoc();
                                                                                                                                                            echo $d2['address'];
                                                                                                                                                        }
                                                                                                                                                        ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary" id="saveProfileChanges">Save Changes</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <form action="" id="changePwCheck">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 mb-3">
                                                        <div class="mb-2"><b>Change Password</b></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <p class="text-danger" id="chngPwWrn"></p>

                                                                <div class="form-group">
                                                                    <label>Current Password</label>
                                                                    <input class="form-control" type="password" name="curpw" placeholder="••••••">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>New Password</label>
                                                                    <input class="form-control" type="password" name="newpw" placeholder="••••••">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                                                    <input class="form-control" type="password" name="repw" placeholder="••••••">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="mt-2 btn btn-primary" id="pwChangeButton">Change Password</button>
                                                    </div>

                                            </form>
                                            <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                                                <div class="mb-2"><b></b></div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label></label>
                                                        <div class="custom-controls-stacked px-2">
                                                            <div class="custom-control custom-checkbox">
                                                                <!-- <input type="checkbox" class="custom-control-input" id="notifications-blog" checked> -->
                                                                <!-- <label class="custom-control-label" for="notifications-blog">Blog posts</label> -->
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <!-- <input type="checkbox" class="custom-control-input" id="notifications-news" checked> -->
                                                                <!-- <label class="custom-control-label" for="notifications-news">Newsletter</label> -->
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <!-- <input type="checkbox" class="custom-control-input" id="notifications-offers" checked> -->
                                                                <!-- <label class="custom-control-label" for="notifications-offers">Personal Offers</label> -->
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
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <?php include "footer.php" ?>

    <script src="js/ajax.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
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

</body>

</html>