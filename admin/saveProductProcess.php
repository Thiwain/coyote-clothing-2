<?php


$length = sizeof($_FILES);
$pid = $_POST['pid'];

if ($length <= 3 && $length > 0) {

    $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

    for ($x = 0; $x < $length; $x++) {
        if (isset($_FILES["image" . $x])) {

            $image_file = $_FILES["image" . $x];
            $file_extension = $image_file["type"];

            if (in_array($file_extension, $allowed_image_extensions)) {

                $new_img_extension;

                if ($file_extension == "image/jpeg") {
                    $new_img_extension = ".jpeg";
                } else if ($file_extension == "image/png") {
                    $new_img_extension = ".png";
                } else if ($file_extension == "image/svg+xml") {
                    $new_img_extension = ".svg";
                }

                $file_name = "resource//mobile_images//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                move_uploaded_file($image_file["tmp_name"], $file_name);

                Database::iud("INSERT INTO `coyote_clothing`.`product_sub_images` (`img_path`, `product_id`) VALUES ('$file_name', '$pid')");
                Database::iud("INSERT INTO `coyote_clothing`.`product_img` (`product_id`, `path`) VALUES ('$pid', '$file_name')");
            } else {
                echo ("Inavid image type.");
            }
        }
    }
}
