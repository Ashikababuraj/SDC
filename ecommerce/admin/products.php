<?php
// admin/products.php
include '../db.php';

// Get all products
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Products</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h3>Admin - Products</h3>

    <a href="../index.php" class="btn btn-secondary btn-sm mb-3">← View Website</a>
    <a href="add_product.php" class="btn btn-primary btn-sm mb-3">+ Add Product</a>

    <?php if (isset($_GET['added'])): ?>
        <div class="alert alert-success py-2">Product added successfully!</div>
    <?php endif; ?>

    <?php if (isset($_GET['updated'])): ?>
        <div class="alert alert-success py-2">Product updated successfully!</div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-danger py-2">Product deleted successfully!</div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="60">ID</th>
            <th width="120">Image</th>
            <th>Name</th>
            <th width="120">Price (₹)</th>
            <th width="220">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td>
                        <?php if (!empty($row['image'])): ?>
                            <img src="../uploads/products/<?= htmlspecialchars($row['image']); ?>"
                                 width="80" alt="">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= number_format($row['price'], 2); ?></td>
                    <td>
                        <a href="../product_details.php?id=<?= $row['id']; ?>"
                           class="btn btn-sm btn-info" target="_blank">View</a>

                        <a href="edit_product.php?id=<?= $row['id']; ?>"
                           class="btn btn-sm btn-warning">Edit</a>

                        <a href="delete_product.php?id=<?= $row['id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this product?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No products found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

</body>
</html>
