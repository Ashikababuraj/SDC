<?php
session_start();

$username_error = $_GET['username_error'] ?? "";
$password_error = $_GET['password_error'] ?? "";
$general_error  = $_GET['general_error'] ?? "";
$old_username   = $_GET['old_username'] ?? "";

// If any error message is passed, show it. If not, keep it empty.

// print_r($_SESSION['admin']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>

<h2>Admin Login</h2>

<?php if ($general_error): ?>
    <p style="color:red;"><?= $general_error ?></p>
<?php endif; ?>

<form method="POST" action="login_check.php">

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= htmlspecialchars($old_username) ?>">
    <!-- We show the previous username again so the student does not need to re-type it. -->
    <br>
    <small style="color:red;"><?= $username_error ?></small>
    <br><br>

    <label>Password:</label><br>
    <input type="password" name="password">
    <br>
    <small style="color:red;"><?= $password_error ?></small>
    <br><br>

    <button type="submit" name="login">Login</button>



</form>

</body>
</html>
