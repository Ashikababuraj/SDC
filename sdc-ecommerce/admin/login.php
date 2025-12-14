<?php
session_start();
include "../config/db.php";

$username_error = $password_error = $login_error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if($username == ""){
        $username_error = "Username is required";
    }
    if($password == ""){
        $password_error = "Password is required";
    }

    if($username && $password){

        $query = "SELECT * FROM admins WHERE username='$username' AND status=1";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result) == 1){
            $admin = mysqli_fetch_assoc($result);

            if(password_verify($password, $admin['password'])){
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];

                header("Location: dashboard.php");
                exit;
            } else {
                $login_error = "Invalid password";
            }

        } else {
            $login_error = "Admin not found";
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Myntra Online Shopping Admin Login</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.webp" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../img/logo.png" style="height: 50px;" alt="">
                </a>
                <p class="text-center">Admin Login</p>

                <?php if($login_error): ?>
                  <div class="alert alert-danger"><?= $login_error ?></div>
                <?php endif; ?>

                <form method="POST">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small class="text-danger"><?= $username_error ?></small>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password"  class="form-control" id="exampleInputPassword1">
                    <small class="text-danger"><?= $password_error ?></small>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                   
                    <!-- <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a> -->
                  </div>

                  <button type="submit" name="login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                      Login
                  </button>

                 
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>