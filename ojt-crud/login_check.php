<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // trim() removes spaces.

    $username_error = "";
    $password_error = "";
    $general_error  = "";
    $hasError = false;

    // Validation
    if ($username == "") {
        $username_error = "Username is required";
        $hasError = true;
    }

    if ($password == "") {
        $password_error = "Password is required";
        $hasError = true;
    }

    // If validation fails → redirect back
    if ($hasError) {
        $query = http_build_query([
            'username_error' => $username_error,
            'password_error' => $password_error,
            'old_username'   => $username
        ]);

        header("Location: login.php?$query");
        exit;
        // This takes the user back to login.php and shows errors below the inputs.
    }

    // Very simple login query (for study purpose)
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {

        $_SESSION['admin'] = $username; //We save admin name in session so we know the admin is logged in.
        header("Location: add_student.php");
        exit;

    } else {
        $general_error = "Invalid username or password";
        header("Location: login.php?general_error=" . urlencode($general_error) . "&old_username=$username");
        exit;
    }
}


