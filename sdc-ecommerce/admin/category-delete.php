<?php
include "includes/auth_check.php";
include "../config/db.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM categories WHERE id=$id");

header("Location: categories-list.php");
exit;


?>