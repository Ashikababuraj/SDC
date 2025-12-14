<?php
include "includes/auth_check.php";
include "../config/db.php";


$product_id = $_GET['product_id'] ?? 0;

if (!$product_id) {
    die("Invalid Product");
}

/* ===============================
   ADD COLOR (POST → REDIRECT → GET)
   =============================== */
if (isset($_POST['add_color'])) {

    $color_name = trim($_POST['color_name']);
    $color_code = $_POST['color_code'];

    if ($color_name != "") {

        // Prevent duplicate color for same product
        $check = mysqli_query($conn,
            "SELECT id FROM product_colors
             WHERE product_id='$product_id'
             AND (color_name='$color_name' OR color_code='$color_code')"
        );

        if (mysqli_num_rows($check) > 0) {
            $_SESSION['error'] = "Color already exists for this product!";
        } else {
            mysqli_query($conn,
                "INSERT INTO product_colors (product_id, color_name, color_code)
                 VALUES ('$product_id','$color_name','$color_code')"
            );
            $_SESSION['success'] = "Color added successfully!";
        }
    }

    // 🔑 Redirect to avoid form resubmission
    header("Location: product-colors.php?product_id=".$product_id);
    exit;
}

/* ===============================
   FETCH COLORS
   =============================== */
$colors = mysqli_query($conn,
    "SELECT * FROM product_colors
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
                      <h4 class="card-title">Manage Product Colors</h4>
                     
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
                    <div class="mt-5 d-flex gap-3">
                        <input type="text"
                               name="color_name"
                               class="form-control"
                               placeholder="Color name (Red, Black)"
                               required
                               style="max-width:250px;">

                        <input type="color"
                               name="color_code"
                               class="form-control form-control-color">

                        <button name="add_color" class="btn btn-primary">
                            Add Color
                        </button>
                    </div>
                </form>

                  
                  <h4 class="card-title mt-5">Product Sizes</h4>
                  <table class="table table-bordered mb-0 text-nowrap align-middle">
                    
                    <tr>
                        <th scope="col" class="text-black">Color</th>
                        <th scope="col" class="text-black">Preview</th>
                        <th scope="col" class="text-black">Status</th>
                        <th scope="col" class="text-black">Action</th>
                    </tr>

                    <?php if(mysqli_num_rows($colors) > 0): ?>
                    <?php while($c = mysqli_fetch_assoc($colors)): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['color_name']); ?></td>

                        <td>
                            <span style="
                                width:30px;
                                height:30px;
                                border-radius:50%;
                                display:inline-block;
                                background:<?= $c['color_code']; ?>;
                                border:1px solid #ccc;">
                            </span>
                        </td>

                        <td>
                            <span class="badge <?= $c['status'] ? 'bg-success' : 'bg-danger'; ?>">
                                <?= $c['status'] ? 'Active' : 'Inactive'; ?>
                            </span>
                        </td>

                        <td>
                            <a href="delete-color.php?id=<?= $c['id']; ?>&product_id=<?= $product_id; ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Delete this color?')">
                               Delete
                            </a>
                        </td>


                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No colors added</td>
                    </tr>
                <?php endif; ?>
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
  




