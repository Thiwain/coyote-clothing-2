<?php
session_start();

require 'connection.php';

$address = $_POST['address'];
$email = $_POST['curemail'];

if (empty($email)) {
    echo 'Email is required';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email address';
} else if ($_SESSION["u"]["email"] != $email) {
    $existingUserQuery = "SELECT * FROM `user` WHERE `email` = '$email'";
    $existingUserResult = Database::search($existingUserQuery);

    if ($existingUserResult->num_rows > 0) {
        echo "User with the same email already exists";
    } else {
        Database::iud("UPDATE `user` SET `email` = '$email' WHERE `id` = '" . $_SESSION["u"]["id"] . "'");
        $_SESSION["u"]["email"] = $email; // Fixing the session variable assignment
    }
}

$existingUserQuery2 = "SELECT * FROM `user_address` WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'";
$rs = Database::search($existingUserQuery2);

if ($rs->num_rows == 1) {
    $d2 = $rs->fetch_assoc();
    if ($address != $d2['address']) {
        Database::iud("UPDATE `user_address` SET `address` = '$address' WHERE `user_id` = '" . $_SESSION["u"]["id"] . "'");
    }
} else {
    Database::iud("INSERT INTO user_address (`user_id`, `address`)
    VALUES ('" . $_SESSION["u"]["id"] . "', '$address')
    ");
}

echo 'Profile updated';
