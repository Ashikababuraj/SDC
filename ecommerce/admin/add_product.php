<?php
// admin/add_product.php
include '../db.php';

$name = $price = $description = "";
$name_error = $price_error = "";
$image_error = "";

if (isset($_POST['save'])) {

    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $description = trim($_POST['description'] ?? '');

    $hasError = false;

    if ($name === "") {
        $name_error = "Product name is required";
        $hasError = true;
    }

    if ($price === "") {
        $price_error = "Price is required";
        $hasError = true;
    } elseif (!is_numeric($price)) {
        $price_error = "Price must be a number";
        $hasError = true;
    }

    // Handle image upload
    $image_name = "";
    if (!empty($_FILES['image']['name'])) {
        $upload_dir = "../uploads/products/";
        $original = basename($_FILES['image']['name']);
        $image_name = time() . "_" . preg_replace("/[^A-Za-z0-9\._-]/", "_", $original);
        $target_path = $upload_dir . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $image_error = "Failed to upload image";
            $hasError = true;
        }
    }

    if (!$hasError) {
        $desc_escaped = $conn->real_escape_string($description);

        $sql = "INSERT INTO products (name, price, description, image)
                VALUES ('$name', '$price', '$desc_escaped', '$image_name')";
        $conn->query($sql);

        header("Location: products.php?added=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h3>Add New Product</h3>
    <a href="products.php" class="btn btn-secondary btn-sm mb-3">← Back to Products</a>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control"
                   value="<?= htmlspecialchars($name); ?>">
            <small class="text-danger"><?= $name_error; ?></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (₹)</label>
            <input type="text" name="price" class="form-control"
                   value="<?= htmlspecialchars($price); ?>">
            <small class="text-danger"><?= $price_error; ?></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($description); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <input type="file" name="image" class="form-control">
            <small class="text-danger"><?= $image_error; ?></small>
        </div>

        <button type="submit" name="save" class="btn btn-primary">Save Product</button>

    </form>
</div>

</body>
</html>
