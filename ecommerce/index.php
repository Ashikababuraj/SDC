<style>
    .card-img, .card-img-bottom, .card-img-top {
    width: 100%;
    height: 400px;
    object-fit: cover;
}
</style>



<?php
session_start();
include 'db.php';

// Add to Cart
if (isset($_GET['add'])) {
    $id = $_GET['add'];

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }

    header("Location: index.php?added=1");
    exit;
}

$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Simple Ecommerce Shop</h2>

    <a href="cart.php" class="btn btn-primary mb-3">
        Cart (<?= array_sum($_SESSION['cart'] ?? []); ?>)
    </a>

    <?php if (isset($_GET['added'])): ?>
        <div class="alert alert-success">Product added to cart!</div>
    <?php endif; ?>

    <div class="row">
        <?php while ($p = $products->fetch_assoc()): ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="uploads/products/<?= $p['image'] ?>" class="card-img-top" height="200">
                    <div class="card-body">
                        <h5><?= $p['name'] ?></h5>
                        <p>₹<?= number_format($p['price'], 2) ?></p>
                        <a href="product_details.php?id=<?= $p['id'] ?>" class="btn btn-secondary btn-sm">View</a>
                        <a href="index.php?add=<?= $p['id'] ?>" class="btn btn-success btn-sm">Add to Cart</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
