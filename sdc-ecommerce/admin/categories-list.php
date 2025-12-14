<?php
include "includes/auth_check.php";
include "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
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
                      <h4 class="card-title">Category Listing</h4>
                     
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                      <a class="btn btn-primary d-flex align-items-center gap-1 " href="categories-add.php">
                        <i class="ti ti-layout-grid fs-5"></i>
                        Add Category
                        <i class="ti ti-plus fs-5"></i>
                      </a>
                     
                    </div>
                  </div>
                  <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                      <thead>
                        <tr>
                          <th scope="col" class="px-0 text-muted">
                            ID
                          </th>
                          <th scope="col" class="px-0 text-muted">Category Name</th>
                          <th scope="col" class="px-0 text-muted">
                            Status
                          </th>
                          <th scope="col" class="px-0 text-muted text-end">
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                         
                          <tr>
                              <td class="px-0"><?= $i++; ?></td>
                              <td class="px-0"><?= $row['name'] ?></td>
                              <td class="px-0">
                               
                                <span class="badge <?= $row['status'] ? 'bg-info' : 'bg-danger' ?>">
                                  <?= $row['status'] ? 'Active' : 'Inactive' ?>
                                </span>
                              </td>
                              <td class="px-0">
                                  <a href="category-edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                  <a href="category-delete?id=<?= $row['id'] ?>" 
                                     class="btn btn-sm btn-danger"
                                     onclick="return confirm('Delete this category?')">
                                     Delete
                                  </a>
                              </td>
                          </tr>

                          <?php 
                           
                          endwhile;
                           
                         ?>


                        
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
  




