<?php
include "includes/auth_check.php";
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
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12"><h3 class="fw-semibold mb-4 myntra-color">Overview of Myntra Online Shopping</h3></div>

                  <div class="col-md-4">
                    
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Total Products Count</h5>
                        <h2 class="mb-2 mt-3"><strong>140</strong></h2>                    
                      </div>
                    </div>
                  </div>


                  <div class="col-md-4">                    
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Total Categories Count</h5>
                        <h2 class="mb-2 mt-3"><strong>140</strong></h2>                    
                      </div>
                    </div>
                  </div>


                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Total Orders Count</h5>
                        <h2 class="mb-2 mt-3"><strong>140</strong></h2>                    
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Total Users Count</h5>
                        <h2 class="mb-2 mt-3"><strong>140</strong></h2>                    
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
         
          
          </div>
          
        </div>
      </div>
    </div>
  </div>
