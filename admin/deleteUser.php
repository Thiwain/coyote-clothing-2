<?php
session_start();
require '../connection.php';

$user_id = $_POST['user_id'];

Database::iud("DELETE FROM `user` WHERE `id`='" . $user_id . "'");

echo "delete";
