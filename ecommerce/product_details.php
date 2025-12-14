<?php
include 'db.php';
$id = $_GET['id'];
$p = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $p['name'] ?></title>
</head>
<body>

<div class="container mt-4">
    <h3><?= $p['name'] ?></h3>
    <img src="uploads/products/<?= $p['image'] ?>" width="300">
    <p><?= $p['description'] ?></p>
    <h4>₹<?= $p['price'] ?></h4>

    <a href="index.php?add=<?= $p['id'] ?>" class="btn btn-primary">Add to Cart</a>
</div>

</body>
</html>
