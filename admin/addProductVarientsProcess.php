<?php

require 'connection.php';

$name = $_POST['vname'];
$qty = $_POST['vQty'];
$pid = $_POST['pid'];

Database::iud("INSERT INTO `coyote_clothing`.`varient` (`product_id`, `vname`, `qty`, `varient_title_id`) VALUES ($pid, '$name', '$qty', 1)");
