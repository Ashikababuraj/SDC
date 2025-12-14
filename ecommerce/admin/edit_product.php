<?php
// admin/edit_product.php
include '../db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch existing product
$res = $conn->query("SELECT * FROM products WHERE id = $id");
if (!$res || $res->num_rows == 0) {
    die("Product not found");
}
$product = $res->fetch_assoc();

$name = $product['name'];
$price = $product['price'];
$description = $product['description'];
$current_image = $product['image'];

$name_error = $price_error = $image_error = "";

if (isset($_POST['update'])) {

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

    $new_image_name = $current_image;

    // If new image uploaded, replace
    if (!empty($_FILES['image']['name'])) {
        $upload_dir = "../uploads/products/";
        $original = basename($_FILES['image']['name']);
        $new_image_name = time() . "_" . preg_replace("/[^A-Za-z0-9\._-]/", "_", $original);
        $target_path = $upload_dir . $new_image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $image_error = "Failed to upload image";
            $hasError = true;
        } else {
            // Optionally delete old image file
            if (!empty($current_image) && file_exists($upload_dir . $current_image)) {
                @unlink($upload_dir . $current_image);
            }
        }
    }

    if (!$hasError) {
        $desc_escaped = $conn->real_escape_string($description);

        $sql = "UPDATE products
                SET name='$name',
                    price='$price',
                    description='$desc_escaped',
                    image='$new_image_name'
                WHERE id = $id";
        $conn->query($sql);

        header("Location: products.php?updated=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h3>Edit Product</h3>
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
            <label class="form-label">Current Image</label><br>
            <?php if (!empty($current_image)): ?>
                <img src="../uploads/products/<?= htmlspecialchars($current_image); ?>" width="120" alt=""><br><br>
            <?php else: ?>
                <p>No image uploaded.</p>
            <?php endif; ?>

            <label class="form-label">Change Image (optional)</label>
            <input type="file" name="image" class="form-control">
            <small class="text-danger"><?= $image_error; ?></small>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Product</button>

    </form>
</div>

</body>
</html>
