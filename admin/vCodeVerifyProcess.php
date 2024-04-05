<?php
session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $verificationCode = $_POST['vcode'];

    $query = "SELECT * FROM admin_user WHERE email = '$email' AND vcode = '$verificationCode'";
    $result = Database::search($query);
    $count = mysqli_num_rows($result);

    $d = $result->fetch_assoc();
    $_SESSION["au"] = $d;

    if ($count == 1) {
        echo "success";
    } else {
        echo "Invalid details";
    }
}
