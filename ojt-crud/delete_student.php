<?php
include 'db.php';

$id = $_GET['id'] ?? 0;

if($id == 0){
    die("Invalid ID");
}

// Delete student
$conn->query("DELETE FROM students WHERE id=$id");

header("Location: list_students.php?msg=deleted");
exit;
?>
