<?php
session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $errors = [];

    if (empty($fname) || empty($lname)) {
        $errors[] = "First name and last name are required";
    }

    if (empty($gender)) {
        $errors[] = "Gender is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }

    if ($password !== $repassword) {
        $errors[] = "Passwords do not match";
    }
    if (empty($errors)) {
        $existingUserQuery = "SELECT * FROM `user` WHERE `email` = '$email'";
        $existingUserResult = Database::search($existingUserQuery);

        if ($existingUserResult->num_rows > 0) {
            // User with the same email already exists
            echo "User with the same email already exists";
        } else {

            $boolean = true;

            $currentDateTime = date("Y-m-d H:i:s");

            if ($boolean == true) {
                $insertUserQuery = "INSERT INTO `user` (`fname`, `lname`, `gender_id`, `email`, `password`,`joined_date`) VALUES ('$fname', '$lname', $gender, '$email', '$password','$currentDateTime')";
                Database::iud($insertUserQuery);
                $boolean = false;
            }

            if ($boolean == false) {

                $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' 
AND `password`='" . $password . "'");

                $d = $rs->fetch_assoc();
                $_SESSION["u"] = $d;
            }
            echo "pass";
        }
    } else {
        echo implode("<br>", $errors);
    }
} else {
    echo "Invalid request!";
}
