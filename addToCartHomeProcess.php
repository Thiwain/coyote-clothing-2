<?php
session_start();

require 'connection.php';

if (isset($_SESSION["u"])) {

    $pid = $_POST['pid'];
    $user = $_SESSION["u"]["id"];

    $pSearch = Database::search("SELECT * FROM `cart` WHERE `user_id` = '$user' AND `product_id` = '$pid'");
    $pCount = $pSearch->num_rows;
    $pData = $pSearch->fetch_assoc();

    $vSearch = Database::search("SELECT * FROM `varient` WHERE `product_id` = '$pid' ORDER BY `id` ASC");
    $vCount = $vSearch->num_rows;
    $vData = $vSearch->fetch_assoc();

    $vid = $vData["id"];

    if ($pCount == 1) {
        $qty = $pData['qty'] + 1;
        Database::iud("UPDATE `coyote_clothing`.`cart` SET `qty`='$qty' WHERE `user_id`='$user' AND `product_id`='$pid'");
    } else {
        Database::iud("INSERT INTO `coyote_clothing`.`cart` (`user_id`, `product_id`, `varient_id`, `qty`) VALUES ('$user', '$pid', '$vid', 1)");
    }
} else {
    echo 'toSignUp';-
}
