<?php

require 'connection.php';

$itemName = $_POST['item'];
$cat_id = $_POST['cat'];

Database::iud("INSERT INTO `coyote_clothing`.`item` (`item_name`, `category_id`) VALUES ('$itemName', $cat_id);");

echo 'item added';
