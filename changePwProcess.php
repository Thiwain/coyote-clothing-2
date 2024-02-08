<?php
session_start();
require 'connection.php';

$cp = $_POST['curpw'];
$np = $_POST['newpw'];
$rp = $_POST['repw'];

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

if (empty($cp)) {
    echo 'Please fill the current password';
} else if ($cp != $_SESSION["u"]["password"]) {
    echo 'Current password does not match';
} else if (empty($np)) {
    echo 'Please fill the new password';
} else if ($np == $_SESSION["u"]["password"]) {
    echo 'New password cannot be the same as the current password';
} else if (!isValidPassword($np)) {
    echo 'Password is weak';
} else if (empty($rp)) {
    echo 'please confirm the password';
} else if ($np != $rp) {
    echo 'Password does not match';
} else {


    Database::iud("UPDATE user
    SET password = '$np'
    WHERE email = '{$_SESSION["u"]["email"]}';
    ");

    $_SESSION["u"]["password"] = $np;


    echo 'Password is changed';
}
