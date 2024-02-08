<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coyote | Reset Password</title>
    <link href="resources/logo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <div class="row justify-content-center align-items-center">
                    <h3 class="text-dark fw-bold mt-3">Forgot Password</h3>
                </div>
            </div>
            <p class="nPwWarn"></p>
            <div class="col-10 col-md-5 col-lg-3 gap-3">
                <form id="resetPasswordFormS">
                    <input type="password" class="form-control mt-3" placeholder="New Password" name="np"/>
                    <input type="password" class="form-control mt-3" placeholder="Confirm Password" name="cp"/>
                </form>
            </div>
            <div class="col-12 mt-3">
                <div class="row justify-content-center align-items-center">
                    <button id="resetPwBtnS" onclick="resetPw();" class="btn btn-primary">Change Password</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/ajax.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main2.js"></script>
    <script src="js/popper.js"></script>
</body>

</html>