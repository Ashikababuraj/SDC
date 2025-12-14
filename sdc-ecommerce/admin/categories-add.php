<?php
include "includes/auth_check.php";
include "../config/db.php";

$error = "";

if(isset($_POST['save'])){
    $name = trim($_POST['name']);

    if($name == ""){
        $error = "Category name is required";
    } else {
        mysqli_query($conn, "INSERT INTO categories (name) VALUES ('$name')");
        header("Location: categories-list.php");
        exit;
    }
}


?>



  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  App Topstrip -->
    <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
        <a class="d-flex justify-content-center" href="#">
          <img src="assets/images/logos/favicon.webp" alt="" width="40">
        </a>

        
      </div>

      <div class="d-lg-flex align-items-center gap-2">
        <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center">Myntra Online Shopping Admin Dashboard</h3>
        <div class="d-flex align-items-center justify-content-center gap-2">
          
        
        </div>
      </div>

    </div>
    <!-- Sidebar Start -->
    <?php include 'includes/navbar.php'; ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include 'includes/header.php'; ?>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 -->
          <div class="row">
              <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Category Adding</h4>
                     
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                      <a class="btn btn-primary d-flex align-items-center gap-1 " href="categories-list.php">
                        <i class="ti ti-layout-grid fs-5"></i>
                        Manage Category
                        <i class="ti ti-eye fs-5"></i>
                      </a>
                     
                    </div>
                  </div>


                  <form  method="POST" class="mt-5">
                    <div class="mb-3">
                      <label for="CategoryName" class="form-label">Category Name</label>
                      <input type="text" class="form-control" id="CategoryName" name="name">
                      <small class="text-danger"><?= $error ?></small>
                    </div>
                    
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <a href="dashboard.php" class="btn btn-secondary">Back</a>
                  </form>
                  
                  

                </div>
              </div>
            </div>
         
          
          </div>
          
        </div>
      </div>
    </div>
  </div>
  




