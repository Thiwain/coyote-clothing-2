<?php

session_start();

require 'connection.php';

$uid = $_SESSION['u']['id'];
$cid = $_POST['cid'];

Database::iud("DELETE FROM cart WHERE user_id='$uid' AND cart_id='$cid'");

