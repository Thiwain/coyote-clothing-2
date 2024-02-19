<?php
session_start();
require 'connection.php';

if (isset($_SESSION)) {

    $pid = $_POST['pid'];
    $varient = $_POST['varient'];
    $qty = $_POST['qty'];
    $user = $_SESSION["u"]["id"];

    $pSearch = Database::search("SELECT * FROM `cart` WHERE `user_id` = '$user' AND `product_id` = '$pid' AND `varient_id`='$varient'");
    $pCount = $pSearch->num_rows;
    $pData = $pSearch->fetch_assoc();

    $vSearch = Database::search("SELECT * FROM `varient` WHERE `product_id` = '$pid' ORDER BY `id` ASC");
    $vCount = $vSearch->num_rows;
    $vData = $vSearch->fetch_assoc();

    $vid = $vData["id"];

    if ($pCount == 1) {
        $qty_2 = $pData['qty'] + $qty;
        Database::iud("UPDATE `coyote_clothing`.`cart` SET `qty`='$qty_2' WHERE `user_id`='$user' AND `product_id`='$pid' AND `varient_id`='$varient'");
        echo 'product updated successfully';
    } else {
        Database::iud("INSERT INTO `coyote_clothing`.`cart` (`user_id`, `product_id`, `varient_id`, `qty`) VALUES ('$user', '$pid', '$varient', '$qty')");
        echo 'product added successfully';
    }
} else {
    echo 'toSignUp';
}
