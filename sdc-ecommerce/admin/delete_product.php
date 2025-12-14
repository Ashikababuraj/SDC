<?php
// admin/delete_product.php
include '../db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Get product (so we can delete image also)
$res = $conn->query("SELECT image FROM products WHERE id = $id");
if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $image = $row['image'];

    // Delete product
    $conn->query("DELETE FROM products WHERE id = $id");

    // Delete image file if exists
    if (!empty($image)) {
        $path = "../uploads/products/" . $image;
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}

header("Location: products.php?deleted=1");
exit;
