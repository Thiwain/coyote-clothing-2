<?php

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
    /*
    INSERT INTO coyote_clothing.invoice (user_id, order_sts_id, shipping_charge_id, total, datetime) 
    VALUES (1, 1, 1, 100.00, '2024-02-23 12:00:00');
    INSERT INTO coyote_clothing.invoice_item (invoice_id, product_id, varient_id, qty) 
    VALUES (1, 1, 1, 2);
    */
    echo 'Validation successful. Proceed with further processing.';
}
