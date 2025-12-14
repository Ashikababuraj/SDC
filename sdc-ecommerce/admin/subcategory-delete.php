<?php
include "includes/auth_check.php";
include "../config/db.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM subcategories WHERE id=$id");

header("Location: subcategories-list.php");
exit;


?>