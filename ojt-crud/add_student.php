<?php

include 'db.php';


$name = $email = $mobile = $status = "";
$name_error = $email_error = $mobile_error = $status_error = "";


$show_success = isset($_GET['success']) && $_GET['success'] == '1';

if (isset($_POST['save'])) {

    $name   = $_POST['name'] ?? '';
    $email  = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $status = $_POST['status'] ?? '';

    $hasError = false;

    // PHP Validation
    if ($name == "") {
        $name_error = "Name is required!";
        $hasError = true;
    }

    if ($email == "") {
        $email_error = "Email is required!";
        $hasError = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Enter a valid email!";
        $hasError = true;
    }

    if ($mobile == "") {
        $mobile_error = "Mobile is required!";
        $hasError = true;
    } elseif (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $mobile_error = "Mobile must be 10 digits!";
        $hasError = true;
    }

    if ($status === "") {
        $status_error = "Select a status!";
        $hasError = true;
    }

    if (!$hasError) {

        $conn->query("
            INSERT INTO students (name, email, mobile, status)
            VALUES ('$name', '$email', '$mobile', '$status')
        ");

        header("Location: add_student.php?success=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">

<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<h2 style="text-transform: capitalize;">Welcome , <?= $_SESSION['admin']; ?></h2>

<a href="logout.php">Logout</a>

    <div class="row">
        <div class="d-flex justify-content-between">
            <h3>Add New Student</h3>
            <a href="list_students.php" class="btn btn-warning">View Students</a>
        </div>
    </div>


    <form id="studentForm" method="POST" action="">

        <div class="mb-3">
            <label class="form-label">Name<i class="text-danger">*</i></label>
            <input type="text" class="form-control" name="name" id="name"
                   value="<?= htmlspecialchars($name) ?>">
            <small class="text-danger" id="name_error"><?= $name_error ?></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Email<i class="text-danger">*</i></label>
            <input type="text" class="form-control" name="email" id="email"
                   value="<?= htmlspecialchars($email) ?>">
            <small class="text-danger" id="email_error"><?= $email_error ?></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Mobile<i class="text-danger">*</i></label>
            <input type="text" class="form-control" name="mobile" id="mobile"
                   value="<?= htmlspecialchars($mobile) ?>">
            <small class="text-danger" id="mobile_error"><?= $mobile_error ?></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Status<i class="text-danger">*</i></label>
            <select class="form-select" name="status" id="status">
                <option value="">-- Select Status --</option>
                <option value="1" <?= $status === "1" ? "selected" : "" ?>>Active</option>
                <option value="0" <?= $status === "0" ? "selected" : "" ?>>Inactive</option>
            </select>
            <small class="text-danger" id="status_error"><?= $status_error ?></small>
        </div>

        <button type="submit" name="save" class="btn btn-primary">Submit</button>
        <a href="add_student.php" class="btn btn-secondary">Back</a>

    </form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$("#studentForm").submit(function(e){

    // Clear old error messages
    $("small.text-danger").text("");

    let isValid = true;

    let name   = $('#name').val().trim();
    let email  = $('#email').val().trim();
    let mobile = $('#mobile').val().trim();
    let status = $('#status').val();

    if(name === ""){
        $("#name_error").text("Name is required!");
        isValid = false;
    }

    if(email === ""){
        $("#email_error").text("Email is required!");
        isValid = false;
    } else {
        let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!pattern.test(email)){
            $("#email_error").text("Enter a valid email!");
            isValid = false;
        }
    }

    if(mobile === ""){
        $("#mobile_error").text("Mobile is required!");
        isValid = false;
    } else if(!/^[0-9]{10}$/.test(mobile)){
        $("#mobile_error").text("Mobile must be 10 digits!");
        isValid = false;
    }

    if(status === ""){
        $("#status_error").text("Select a status!");
        isValid = false;
    }

    if(!isValid){
        e.preventDefault(); // stop submit if client-side invalid
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.all.min.js"></script>

<?php if ($show_success): ?>
<script>
Swal.fire({
    title: "Success!",
    text: "Student added successfully!",
    icon: "success",
    confirmButtonText: "OK"
}).then(() => {
    window.location.href = "list_students.php";
});
</script>
<?php endif; ?>

</body>
</html>
