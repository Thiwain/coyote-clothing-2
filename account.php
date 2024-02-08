<!doctype html>
<html lang="en">

<head>
    <title>Sign Up | Log in</title>
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

    <section class="ftco-section bg-light">
        <div class="container">

            <?php

            $email = "";
            $password = "";

            if (isset($_COOKIE["email"])) {
                $email = $_COOKIE["email"];
            }

            if (isset($_COOKIE["password"])) {
                $password = $_COOKIE["password"];
            }

            ?>

            <div class="row justify-content-center d-none" id="signInBox">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(images/bg-1.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Log In</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form action="#" id="signinForm" class="signin-form">
                                <p id="signInWarn" class="text-danger"></p>
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" required name="email" value="<?php echo $email; ?>" />
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input id="password" type="password" class="form-control" placeholder="Password" required name="password" value="<?php echo $password; ?>" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" name="rememberme" value="true" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal" type="button">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">Not a member? <a data-toggle="tab" href="#signup" id="signUpflip" onclick="filpAuth();">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center" id="signUpBox">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(images/bg-1.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign Up</h3>
                                </div>
                                <p id="signUpWarn" class="text-danger"></p>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form action="#" id="signupForm" class="signup-form">
                                <p class="signInWrn" id="signUpWrn"></p>
                                <div class="form-group mb-3 row">
                                    <div class="col-6">
                                        <label class="label" for="name">First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" required name="fname" />
                                    </div>
                                    <div class="col-6">
                                        <label class="label" for="name">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" required name="lname" />
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Gender</label>
                                    <!-- <input type="text" class="form-control" placeholder="Email" required id="email" name="email" /> -->
                                    <select name="gender" class="form-control" id="">
                                        <option value="">--Select Gender--</option>
                                        <?php

                                        require "connection.php";

                                        $rs = Database::search("SELECT * FROM `gender`");
                                        $n = $rs->num_rows;

                                        for ($x = 0; $x < $n; $x++) {
                                            $d = $rs->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                        <?php

                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" required name="email" />
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" required name="password" />
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Re-Type Password</label>
                                    <input type="password" class="form-control" placeholder="Password" required name="repassword" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded px-3">Sign Up</button>
                                </div>

                            </form>
                            <p class="text-center">Alread Have an account? <a data-toggle="tab" href="#signup" id="signUpflip" onclick="filpAuth();">Log In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- f pw modal -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="forgotPwModal">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="label" for="name">Type your email to get veification code</label>
                            <p class="text-danger" id="fpwMoadlWrn"></p>
                            <div class="row">
                                <div class="col-10 offset-1">
                                    <div class="row gap-2">
                                        <input type="text" class="form-control col-9" placeholder="Email" required name="email" />
                                        <button type="button" class="btn btn-primary col-2 offset-1" id="sendVcode">Send</button>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="fpwContinue">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- f pw modal -->

    <?php include "footer.php" ?>

    <script src="js/jquery.min.js"></script>
    <!-- <script src="js/bootstrap.bundle.js"></script> -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/script.js"></script>

</body>

</html>