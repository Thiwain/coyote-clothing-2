<?php
require 'connection.php';
/* desc, title, homeList, item, category */

$uniqueId = intval(substr(uniqid(), 7));



$desc = $_POST['desc'];
$title = $_POST['title'];
$homeList = $_POST['homeList']; //id
$item = $_POST['item']; //id
// $category = $_POST['category']; //id
$price = $_POST['price'];

Database::iud("INSERT INTO `coyote_clothing`.`product` (`id`,`product_title`, `description`, `item_id`, `home_listing_id`, `price`) VALUES ('$uniqueId','$title', '$desc', '$item', '$homeList', '$price')");

echo $uniqueId;
