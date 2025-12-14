<?php
session_start();
include 'db.php';

$cart = $_SESSION['cart'] ?? [];

if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header("Location: cart.php");
    exit;
}

if (isset($_POST['update'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        if ($qty <= 0) unset($_SESSION['cart'][$id]);
        else $_SESSION['cart'][$id] = $qty;
    }
    header("Location: cart.php");
    exit;
}

$products = [];
$total = 0;

if (!empty($cart)) {
    $ids = implode(",", array_keys($cart));
    $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");

    while ($p = $res->fetch_assoc()) {
        $p['qty'] = $cart[$p['id']];
        $p['subtotal'] = $p['price'] * $p['qty'];
        $total += $p['subtotal'];
        $products[] = $p;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Your Cart</h3>

    <?php if (empty($products)): ?>
        <div class="alert alert-info">Cart is Empty</div>
        <a href="index.php" class="btn btn-secondary">Continue Shopping</a>
    <?php else: ?>
        <form method="POST">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th width="100">Price</th>
                    <th width="100">Qty</th>
                    <th width="120">Subtotal</th>
                    <th width="70">Remove</th>
                </tr>

                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= $p['name'] ?></td>
                        <td>₹<?= $p['price'] ?></td>
                        <td>
                            <input type="number" name="qty[<?= $p['id'] ?>]" value="<?= $p['qty'] ?>"
                                   class="form-control">
                        </td>
                        <td>₹<?= $p['subtotal'] ?></td>
                        <td>
                            <a href="cart.php?remove=<?= $p['id'] ?>" class="btn btn-danger btn-sm">X</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th colspan="2">₹<?= $total ?></th>
                </tr>

            </table>

            <button type="submit" name="update" class="btn btn-primary">Update Cart</button>
            <a href="checkout.php" class="btn btn-success">Checkout</a>
        </form>
    <?php endif; ?>

</div>
</body>
</html>
