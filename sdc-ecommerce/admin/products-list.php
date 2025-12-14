<?php
include "includes/auth_check.php";
include "../config/db.php";

$sql = "
SELECT 
    products.*,
    categories.name AS category_name,
    subcategories.name AS subcategory_name
FROM products
LEFT JOIN categories ON products.category_id = categories.id
LEFT JOIN subcategories ON products.subcategory_id = subcategories.id
ORDER BY products.id DESC
";

$result = mysqli_query($conn, $sql);

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
                      <h4 class="card-title">Products Listing</h4>
                     
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                      <a class="btn btn-primary d-flex align-items-center gap-1 " href="products-add.php">
                        <i class="ti ti-layout-grid fs-5"></i>
                        Add Products 
                        <i class="ti ti-plus fs-5"></i>
                      </a>
                     
                    </div>
                  </div>
                  <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                      <thead>
                        <tr>
                            <th scope="col" class="px-0 text-muted">ID</th>
                            <th scope="col" class="px-0 text-muted">Image</th>
                            <th scope="col" class="px-0 text-muted">Product</th>
                            <th scope="col" class="px-0 text-muted">Category</th>
                            <th scope="col" class="px-0 text-muted">Subcategory</th>
                            <th scope="col" class="px-0 text-muted">Price</th>
                            <th scope="col" class="px-0 text-muted">Status</th>
                            <th  scope="col" class="px-0 text-muted width="160">Actions</th>

                          

                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($result) > 0): ?>
                          <?php while($row = mysqli_fetch_assoc($result)): ?>
                          <tr>
                              <td class="px-0"><?= $row['id']; ?></td>

                              <td class="px-0">
                                  <img src="../uploads/products/<?= $row['image']; ?>" 
                                       width="60" height="60" style="object-fit:cover;">
                              </td>

                              <td class="px-0"><?= $row['name']; ?></td>

                              <td class="px-0"><?= $row['category_name'] ?? '—'; ?></td>

                              <td class="px-0"><?= $row['subcategory_name'] ?? '—'; ?></td>

                              <td class="px-0">₹<?= number_format($row['price'],2); ?></td>

                              <td class="px-0">
                                  <span class="badge <?= $row['status'] ? 'bg-success' : 'bg-danger'; ?>">
                                      <?= $row['status'] ? 'Active' : 'Inactive'; ?>
                                  </span>
                              </td>

                              <td class="px-0">
                                  <a href="products-edit.php?id=<?= $row['id']; ?>" 
                                     class="btn btn-sm btn-primary">Edit</a>

                                  <a href="product-sizes.php?product_id=<?= $row['id']; ?>" 
                                     class="btn btn-sm btn-info">
                                     Sizes
                                  </a>

                                  <a href="product-colors.php?product_id=<?= $row['id']; ?>" 
                                     class="btn btn-sm btn-warning">
                                     Colors
                                  </a>

                                  <a href="products-delete.php?id=<?= $row['id']; ?>"
                                     class="btn btn-sm btn-danger"
                                     onclick="return confirm('Delete this product?')">
                                     Delete
                                  </a>
                              </td>
                          </tr>
                          <?php endwhile; ?>
                      <?php else: ?>
                          <tr>
                              <td colspan="8" class="text-center">No products found</td>
                          </tr>
                      <?php endif; ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
         
          
          </div>
          
        </div>
      </div>
    </div>
  </div>
  




