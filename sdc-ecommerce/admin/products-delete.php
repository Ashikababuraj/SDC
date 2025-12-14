<?php
include "../config/db.php";
include "auth_check.php";

$id = $_GET['id'] ?? 0;

// Get image name
$product = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT image FROM products WHERE id=$id")
);

if($product){

    $image_path = "../uploads/products/".$product['image'];

    // Delete image file
    if(file_exists($image_path)){
        unlink($image_path);
    }

    // Delete product
    mysqli_query($conn,"DELETE FROM products WHERE id=$id");
}

header("Location: products-list.php");
exit;
