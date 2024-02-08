<?php
session_start();
require "connection.php";

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPassword($password)
{
    if (strlen($password) < 8) {
        return false;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return false;
    }

    return true;
}

$email = $_POST['email'];
$password = $_POST['password'];
$rememberme = isset($_POST['rememberme']) ? $_POST['rememberme'] : "";

if (!isValidEmail($email)) {
    echo "Invalid email format";
    exit; 
}

$rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' 
AND `password`='" . $password . "'");
$n = $rs->num_rows;

if ($n == 1) {
    echo ("present");
    $d = $rs->fetch_assoc();
    $_SESSION["u"] = $d;

    if ($rememberme == "true") {
        setcookie("email", $email, time() + (60 * 60 * 24 * 365));
        setcookie("password", $password, time() + (60 * 60 * 24 * 365));
    } else {
        setcookie("email", "", -1);
        setcookie("password", "", -1);
    }
} else {
    echo ("absent");
}
