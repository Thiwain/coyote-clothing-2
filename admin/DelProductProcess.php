<?php

require 'connection.php';

$id = $_POST['id'];

Database::iud("DELETE FROM `coyote_clothing`.`product` WHERE  `id`='$id'");
