<?php
include "includes/auth_check.php";
include "../config/db.php";

session_start();

$id = $_GET['id'] ?? 0;
$product_id = $_GET['product_id'] ?? 0;

if ($id) {
    mysqli_query($conn,
        "DELETE FROM product_colors WHERE id=$id"
    );

    $_SESSION['success'] = "Color deleted successfully!";
}

header("Location: product-colors.php?product_id=".$product_id);
exit;
