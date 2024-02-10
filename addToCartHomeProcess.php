<?php

session_start();

require 'connection.php';

if (isset($_SESSION["u"])) {

    $pid = $_POST['pid'];
    $user = $_SESSION["u"]["id"];

    $pSearch = Database::search("SELECT * FROM `cart` WHERE `user_id` = '$user' AND `product_id` = '$pid'");
    $pCount = $pSearch->num_rows;
    $pData = $pSearch->fetch_assoc();

    if ($pCount == 1) {
        $qty = $pData['qty'] + 1;
        Database::iud("UPDATE `coyote_clothing`.`cart` SET `qty`='$qty' WHERE  `user_id`=1 AND `product_id`=1");
    } else {
        Database::iud("INSERT INTO `coyote_clothing`.`cart` (`user_id`, `product_id`, `qty`) VALUES ('$user', '$pid', +1)");
    }
} else {
    echo 'toSignUp';
}
