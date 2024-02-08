<?php

session_start();
require 'connection.php';

$np = $_POST['np'];
$cp = $_POST['cp'];

function isValidPassword($np)
{
    if (strlen($np) < 8) {
        return false;
    }

    if (!preg_match('/[A-Z]/', $np)) {
        return false;
    }

    if (!preg_match('/[a-z]/', $np)) {
        return false;
    }

    if (!preg_match('/[0-9]/', $np)) {
        return false;
    }

    if (!preg_match('/[^a-zA-Z0-9]/', $np)) {
        return false;
    }

    return true;
}

if (empty($np)) {
    echo 'Please fill the new password';
} else if (!isValidPassword($np)) {
    echo 'Password is weak';
} else if (empty($cp)) {
    echo 'Please confirm the password';
} else if ($np != $cp) {
    echo 'Password does not match';
} else {
    $email = $_SESSION["u"]["email"];
    Database::iud("UPDATE `user` SET `password` = '$np' WHERE `email` = '$email'");
    echo 'w';
}
