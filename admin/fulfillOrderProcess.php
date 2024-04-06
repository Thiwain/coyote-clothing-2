<?php

require 'connection.php';

$id = $_POST['id'];

Database::iud("UPDATE `coyote_clothing`.`invoice` SET `order_sts_id`=1 WHERE  `id`=$id;");

echo "updated";
