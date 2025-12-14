<?php
include "includes/auth_check.php";
include "../config/db.php";

$id = $_GET['id'] ?? 0;
$product_id = $_GET['product_id'] ?? 0;

if ($id) {
    mysqli_query($conn,
        "UPDATE product_sizes 
         SET status = IF(status=1,0,1)
         WHERE id=$id"
    );
}

header("Location: product-sizes.php?product_id=".$product_id);
exit;
