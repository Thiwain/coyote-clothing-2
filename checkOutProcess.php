<?php

session_start();

require 'connection.php';

$total = $_POST['total'];
$rname = $_POST['rname'];
$rno = $_POST['rno'];
$address = $_POST['address'];
$email = $_POST['email'];

function hasEnglishLetter($number)
{
    return preg_match('/[a-zA-Z]/', $number);
}

if (empty($total)) {
    echo 'Error occurred during processing.';
} else if (hasEnglishLetter($total)) {
    echo 'Error occurred during processing.';
} else if (empty($rname)) {
    echo 'Name is required';
} else if (empty($rno)) {
    echo 'Mobile number is required';
} else if (hasEnglishLetter($rno)) {
    echo 'Mobile number must contain numbers';
} else if (!preg_match('/^[0-9]{10}$/', $rno)) {
    echo 'Invalid mobile number format. Please enter a 10-digit number.';
} else if (empty($address)) {
    echo 'Address is required';
} else if (empty($email)) {
    echo 'Email is required';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email format';
} else {

    function generateUniqueID($length = 7)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        $id = mt_rand($min, $max);
        return $id;
    }

    $uniqueID = generateUniqueID();
    $uid = $_SESSION["u"]["id"];
    $currentDateTime = date("Y-m-d H:i:s");

    $sts = true;

    if ($sts == true) {
        // payment process
        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $array = array();
        $merchant_id = "1221091";
        $merchant_secret = "MTAwMDM0ODAwMTkxODEyMTM3NzE4MDU3NjE1MDc0MDA3MzAxMjg4";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $uniqueID .
                    number_format($total, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $uniqueID;
        $array["order_id"] = $uniqueID;
        $array["items"] = $order_id;
        $array["amount"] = $total; // in the payhere docs it's exptected to be amount
        $array["first_name"] = $fname;
        $array["last_name"] = $lname;
        $array["contact_number"] = $rno; // refer to the line 5 (reciver's number)
        $array["address"] = $address;
        $array["email"] = $email;
        $array["hash"] = $hash;

        Database::iud("INSERT INTO coyote_clothing.invoice (id, user_id, order_sts_id, shipping_charge_id, total, datetime) 
        VALUES ('$order_id' ,'$uid', 2, 1, '$total', '$currentDateTime')");
        $sts = false;
        echo json_encode($array);
    }

    if ($sts == false) {
        $s_q_res = Database::search("SELECT * FROM `invoice` WHERE `invoice`.`id`='$uniqueID'");
        $s_q_res_fetch = $s_q_res->fetch_assoc();
        $in_id = $s_q_res_fetch['id'];

        if ($s_q_res->num_rows > 0) {

            $cart_res = Database::search("SELECT * FROM cart WHERE cart.user_id='$uid'");
            $cart_count = $cart_res->num_rows;

            for ($i = 0; $i < $cart_count; $i++) {
                $cart_fetch = $cart_res->fetch_assoc();
                Database::iud("INSERT INTO coyote_clothing.invoice_item (invoice_id, product_id, varient_id, qty) 
                VALUES ('$in_id', '" . $cart_fetch['product_id'] . "', '" . $cart_fetch['varient_id'] . "', '" . $cart_fetch['qty'] . "')");

                // Reduce quantity in varient table
                Database::iud("UPDATE varient SET qty = qty - '" . $cart_fetch['qty'] . "' WHERE id = '" . $cart_fetch['varient_id'] . "'");
            }
            Database::iud("INSERT INTO coyote_clothing.shipping_related (invoice_id, mobile, address, r_name) 
            VALUES ('$in_id', '$rno', '$address', '$rname')");
            Database::iud("DELETE FROM cart WHERE user_id='$uid'");
        }
    }

    echo $in_id;
}

/*

<?php

session_start();

require 'connection.php';

$total = $_POST['total'];
$rname = $_POST['rname'];
$rno = $_POST['rno'];
$address = $_POST['address'];
$email = $_POST['email'];

function hasEnglishLetter($number)
{
    return preg_match('/[a-zA-Z]/', $number);
}

if (empty($total)) {
    echo 'Error occurred during processing.';
} else if (hasEnglishLetter($total)) {
    echo 'Error occurred during processing.';
} else if (empty($rname)) {
    echo 'Name is required';
} else if (empty($rno)) {
    echo 'Mobile number is required';
} else if (hasEnglishLetter($rno)) {
    echo 'Mobile number must contain numbers';
} else if (!preg_match('/^[0-9]{10}$/', $rno)) {
    echo 'Invalid mobile number format. Please enter a 10-digit number.';
} else if (empty($address)) {
    echo 'Address is required';
} else if (empty($email)) {
    echo 'Email is required';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email format';
} else {

    function generateUniqueID($length = 7)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        $id = mt_rand($min, $max);
        return $id;
    }

    $uniqueID = generateUniqueID();
    $uid = $_SESSION["u"]["id"];
    $currentDateTime = date("Y-m-d H:i:s");

    $sts = true;

    if ($sts == true) {
        // payment process
        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $array = array();
        $merchant_id = "1221091";
        $merchant_secret = "MTAwMDM0ODAwMTkxODEyMTM3NzE4MDU3NjE1MDc0MDA3MzAxMjg4";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $uniqueID .
                    number_format($total, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $uniqueID;
        $array["order_id"] = $uniqueID;
        $array["items"] = $order_id;
        $array["amount"] = $total; // in the payhere docs it's exptected to be amount
        $array["first_name"] = $fname;
        $array["last_name"] = $lname;
        $array["contact_number"] = $rno; // refer to the line 5 (reciver's number)
        $array["address"] = $address;
        $array["email"] = $email;
        $array["hash"] = $hash;

        Database::iud("INSERT INTO coyote_clothing.invoice (id, user_id, order_sts_id, shipping_charge_id, total, datetime) 
        VALUES ('$order_id' ,'$uid', 2, 1, '$total', '$currentDateTime')");
        $sts = false;
        echo json_encode($array);
    }

    if ($sts == false) {
        $s_q_res = Database::search("SELECT * FROM `invoice` WHERE `invoice`.`id`='$uniqueID'");
        $s_q_res_fetch = $s_q_res->fetch_assoc();
        $in_id = $s_q_res_fetch['id'];

        if ($s_q_res->num_rows > 0) {

            $cart_res = Database::search("SELECT * FROM cart WHERE cart.user_id='$uid'");
            $cart_count = $cart_res->num_rows;

            for ($i = 0; $i < $cart_count; $i++) {
                $cart_fetch = $cart_res->fetch_assoc();
                Database::iud("INSERT INTO coyote_clothing.invoice_item (invoice_id, product_id, varient_id, qty) 
                VALUES ('$in_id', '" . $cart_fetch['product_id'] . "', '" . $cart_fetch['varient_id'] . "', '" . $cart_fetch['qty'] . "')");

                // Reduce quantity in varient table
                Database::iud("UPDATE varient SET qty = qty - '" . $cart_fetch['qty'] . "' WHERE id = '" . $cart_fetch['varient_id'] . "'");
            }
            Database::iud("INSERT INTO coyote_clothing.shipping_related (invoice_id, mobile, address, r_name) 
            VALUES ('$in_id', '$rno', '$address', '$rname')");
            Database::iud("DELETE FROM cart WHERE user_id='$uid'");
        }
    }

    echo $in_id;
}
*/