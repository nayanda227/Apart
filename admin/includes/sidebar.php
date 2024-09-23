<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminApart</span>
      </a>
  
      <!-- Profile Sidebar -->
      <aside class="profile-sidebar">
          <div class="sidebar">
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add your profile menu items here -->
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- Add your profile menu items here -->
                <li class="nav-item">
                  <a href="profil.php" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      Profil
                    </p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-building"></i>
                    <p>
                      Apartment Management
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">              
                    <li class="nav-item">
                      <a href="properties.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Properties</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="properties_media.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Properties Media</p>
                      </a>
                    </li>
                    <?php 
                    if (isset($_SESSION['level'])){
                    if ($_SESSION['level']=="Superadmin"){?>
                    <li class="nav-item">
                      <a href="customers.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Customers</p>
                      </a>
                    </li>
                    <?php }}?>
                    <li class="nav-item">
                      <a href="reservations.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reservations</p>
                      </a>
                    </li>
                    <?php 
                    if (isset($_SESSION['level'])){
                    if ($_SESSION['level']=="Superadmin"){?>
                    <li class="nav-item">
                      <a href="reviews.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reviews</p>
                      </a>
                    </li>
                    <?php }}?>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="konten.php" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                      Konten
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="news.php" class="nav-link">
                    <i class="nav-icon fab fa-blogger"></i>
                    <p>
                      News
                    </p>
                  </a>
                </li>
                <?php 
                if (isset($_SESSION['level'])){
                if ($_SESSION['level']=="Superadmin"){?>
                <li class="nav-item">
                  <a href="user.php" class="nav-link">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>
                      Pengaturan User
                    </p>
                  </a>
                </li>
                <?php }}?>
                <li class="nav-item">
                  <a href="ubahpassword.php" class="nav-link">
                    <i class="nav-icon fas fa-user-lock"></i>
                    <p>
                      Ubah Password
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="signout.php" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                      Sign Out
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>
        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php include("includes/script.php") ?>
    </body>
    </html>
