<?php
include "includes/auth_check.php";
include "../config/db.php";

$product_id = $_GET['product_id'] ?? 0;

if (!$product_id) {
    die("Invalid Product");
}

/* ===============================
   ADD SIZE (POST → REDIRECT → GET)
   =============================== */
if (isset($_POST['add_size'])) {

    $size = trim($_POST['size']);

    if ($size != "") {

        $check = mysqli_query($conn,
            "SELECT id FROM product_sizes 
             WHERE product_id='$product_id' AND size='$size'"
        );

        if (mysqli_num_rows($check) > 0) {
            // ❌ Duplicate found
            $_SESSION['error'] = "Size already exists for this product!";
        } else {
            // ✅ Insert
            mysqli_query($conn,
                "INSERT INTO product_sizes (product_id, size)
                 VALUES ('$product_id','$size')"
            );
            $_SESSION['success'] = "Size added successfully!";
        }
    }

    // 🔑 Redirect (PRG pattern)
    header("Location: product-sizes.php?product_id=".$product_id);
    exit;
}

/* ===============================
   FETCH SIZES
   =============================== */
$sizes = mysqli_query($conn,
    "SELECT * FROM product_sizes 
     WHERE product_id=$product_id 
     ORDER BY id DESC"
);
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
                      <h4 class="card-title">Manage Product Sizes</h4>
                     
                    </div>



                    <div class="ms-auto mt-3 mt-md-0">
                      <a class="btn btn-primary d-flex align-items-center gap-1 " href="products-list.php">
                        <i class="ti ti-layout-grid fs-5"></i>
                        Manage Products
                        <i class="ti ti-eye fs-5"></i>
                      </a>
                     
                    </div>
                  </div>

                  <div class="mt-3">
                      <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $_SESSION['error']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $_SESSION['success']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                  </div>


                  <form method="POST">

                    <div class="mt-5 d-flex">
                        <input type="text" name="size" placeholder="XS / S / M / L" class="form-control me-3" required style="width: 50%;">
                        <button name="add_size" class="btn btn-primary">Add Size</button>
                    </div>
                  </form>

                  
                  <h4 class="card-title mt-5">Product Sizes</h4>
                  <table class="table table-bordered mb-0 text-nowrap varient-table align-middle fs-3">
                    
                    <tr>
                        <th scope="col" class="text-black">Size</th>
                        <th scope="col" class="text-black">Status</th>
                        <th scope="col" class="text-black">Action</th>
                    </tr>

                    <?php while($s=mysqli_fetch_assoc($sizes)): ?>
                    <tr>
                        <td><?= $s['size']; ?></td>
                        <td><?= $s['status']?'Active':'Inactive'; ?></td>
                        <td>
                            <a href="toggle-size.php?id=<?= $s['id']; ?>&product_id=<?= $product_id; ?>">
                                Toggle
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    </table>

                    <!-- <button name="save" class="btn btn-primary">Save Product</button> -->
                    <!-- <a href="dashboard.php" class="btn btn-secondary">Back</a> -->

           
                 
                  
                  

                </div>
              </div>
            </div>
         
          
          </div>
          
        </div>
      </div>
    </div>
  </div>
  





