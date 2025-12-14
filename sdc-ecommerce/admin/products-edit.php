<?php
include "includes/auth_check.php";
include "../config/db.php";

$id = $_GET['id'] ?? 0;

// Fetch product
$product = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM products WHERE id=$id")
);

if(!$product){
    die("Product not found");
}

$error = "";

if(isset($_POST['update'])){

    $name        = trim($_POST['name']);
    $price       = $_POST['price'];
    $description = trim($_POST['description']);
    $status      = $_POST['status'];

    // Image handling
    if($_FILES['image']['name'] != ""){
        $old_image = "../uploads/products/".$product['image'];

        // Delete old image
        if(file_exists($old_image)){
            unlink($old_image);
        }

        $new_image = time().'_'.$_FILES['image']['name'];
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/products/".$new_image
        );
    } else {
        $new_image = $product['image'];
    }

    mysqli_query($conn,"
        UPDATE products SET
        name='$name',
        price='$price',
        description='$description',
        image='$new_image',
        status='$status'
        WHERE id=$id
    ");

    header("Location: products-list.php");
    exit;
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
                      <h4 class="card-title">Update Products</h4>
                     
                    </div>



                    <div class="ms-auto mt-3 mt-md-0">
                      <a class="btn btn-primary d-flex align-items-center gap-1 " href="products-list.php">
                        <i class="ti ti-layout-grid fs-5"></i>
                        Manage Products
                        <i class="ti ti-eye fs-5"></i>
                      </a>
                     
                    </div>
                  </div>


                  <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                      <label>Product Name</label>
                      <input type="text" name="name" class="form-control"
                             value="<?= $product['name']; ?>">
                  </div>

                  <div class="mb-3">
                      <label>Description</label>
                      <textarea name="description" class="form-control"><?= $product['description']; ?></textarea>
                  </div>

                  <div class="mb-3">
                      <label>Price</label>
                      <input type="number" step="0.01" name="price" class="form-control"
                             value="<?= $product['price']; ?>">
                  </div>

                  <div class="mb-3">
                      <label>Current Image</label><br>
                      <img src="../uploads/products/<?= $product['image']; ?>" width="120">
                  </div>

                  <div class="mb-3">
                      <label>Change Image (optional)</label>
                      <input type="file" name="image" class="form-control">
                  </div>

                  <div class="mb-3">
                      <label>Status</label>
                      <select name="status" class="form-control">
                          <option value="1" <?= $product['status']==1?'selected':'' ?>>Active</option>
                          <option value="0" <?= $product['status']==0?'selected':'' ?>>Inactive</option>
                      </select>
                  </div>

                    <button name="update" class="btn btn-primary">Save Product</button>
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
  


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$("#category").change(function(){
    let category_id = $(this).val();

    $("#subcategory").html('<option>Loading...</option>');

    $.ajax({
        url: "get-subcategories.php",
        type: "POST",
        data: { category_id: category_id },
        success: function(response){
            $("#subcategory").html(response);
        }
    });
});
</script>


