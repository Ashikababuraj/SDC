<?php
include "includes/auth_check.php";
include "../config/db.php";

$id = $_GET['id'];
$category = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM categories WHERE id=$id")
);

$error = "";

if(isset($_POST['update'])){
    $name = trim($_POST['name']);
    $status = $_POST['status'];

    if($name == ""){
        $error = "Category name required";
    } else {
        mysqli_query($conn, 
            "UPDATE categories SET name='$name', status='$status' WHERE id=$id"
        );
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
                      <h4 class="card-title">Category Update</h4>
                     
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
                      <label class="form-label">Category Name</label>
                      <input type="text" value="<?= $category['name'] ?>" class="form-control" name="name">
                      <small class="text-danger"><?= $error ?></small>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Status</label>
                      <select name="status" class="form-control">
                          <option value="1" <?= $category['status']==1?'selected':'' ?>>Active</option>
                          <option value="0" <?= $category['status']==0?'selected':'' ?>>Inactive</option>
                      </select>
                  </div>
                    
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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
  




