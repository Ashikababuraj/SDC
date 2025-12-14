<?php
include "includes/auth_check.php";
include "../config/db.php";

$categories = mysqli_query($conn, "SELECT * FROM categories WHERE status=1");
$subcategories = mysqli_query($conn, "SELECT * FROM subcategories WHERE status=1");

$error = "";

if(isset($_POST['save'])){

    $category_id    = $_POST['category_id'];
    $subcategory_id = $_POST['subcategory_id'];
    $name           = trim($_POST['name']);
    $description    = trim($_POST['description']);
    $price          = $_POST['price'];
    $status         = $_POST['status'];

    $image_name = $_FILES['image']['name'];
    $tmp_name   = $_FILES['image']['tmp_name'];

    if($name=="" || $price=="" || $image_name==""){
        $error = "All fields are required";
    } else {

        $new_image = time().'_'.$image_name;

        move_uploaded_file(
            $tmp_name,
            "../uploads/products/".$new_image
        );

        mysqli_query($conn,"
            INSERT INTO products
            (category_id, subcategory_id, name, description, price, image, status)
            VALUES
            ('$category_id','$subcategory_id','$name','$description','$price','$new_image','$status')
        ");

        header("Location: products-list.php");
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
                      <h4 class="card-title">Add Products</h4>
                     
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

                    <div class="mb-3 mt-5">
                      <label class="form-label">Category</label>
                    <select name="category_id" id="category" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php while($c=mysqli_fetch_assoc($categories)): ?>
                            <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                  </div>

                    <div class="mb-3">
                        <label class="form-label">Subcategory</label>
                        <select name="subcategory_id" id="subcategory" class="form-control" required>
                            <option value="">Select Subcategory</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <small class="text-danger"><?= $error ?></small><br>

                    <button name="save" class="btn btn-primary">Save Product</button>
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


