<?php 
session_start();
include('../koneksi/koneksi.php');
$id_user = $_SESSION['id_user'];

// Fetch user information
$sql_user = "SELECT `nama`, `email`, `foto` FROM `user` WHERE `id_user`='$id_user'";
$query_user = mysqli_query($koneksi, $sql_user);
while($data_user = mysqli_fetch_row($query_user)){
    $nama = $data_user[0];
    $email = $data_user[1];
    $foto = $data_user[2];
}

// Handle search query
$search_query = '';
if(isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// Fetch properties data from the database with search filter
$sql_properties = "SELECT `id`, `name`, `rooms`, `total_area`, `price`, `category`, `launch_date`, `description`, `image_url` FROM `properties`";
if(!empty($search_query)) {
    $sql_properties .= " WHERE `name` LIKE '%$search_query%' OR `category` LIKE '%$search_query%'";
}

// Pagination
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query untuk mendapatkan jumlah total data
$sql_total = $sql_properties;
$query_total = mysqli_query($koneksi, $sql_total);
$total_data = mysqli_num_rows($query_total);
$total_pages = ceil($total_data / $limit);

// Query properties dengan limit dan offset
$sql_properties .= " LIMIT $offset, $limit";
$query_properties = mysqli_query($koneksi, $sql_properties);
$properties = [];
while($data = mysqli_fetch_assoc($query_properties)){
    $properties[] = $data;
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-building"></i> Properties</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Properties</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <a href="add_property.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Add Property</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="mb-3">
                    <form action="properties.php" method="get" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by name or category" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if(!empty($_GET['notif']) && $_GET['notif'] == "addberhasil"): ?>
                    <div class="alert alert-success" role="alert">Property Successfully Added</div>
                <?php endif; ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Property Name</th>
                            <th>Rooms</th>
                            <th>Total Area (sqm)</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Launch Date</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>  
                      <?php foreach($properties as $property): ?>
                      <tr>
                        <td><?php echo $property['id']; ?></td>
                        <td><?php echo $property['name']; ?></td>
                        <td><?php echo $property['rooms']; ?></td>
                        <td><?php echo $property['total_area']; ?></td>
                        <td><?php echo $property['price']; ?></td>
                        <td><?php echo $property['category']; ?></td>
                        <td><?php echo $property['launch_date']; ?></td>
                        <td><?php echo $property['description']; ?></td>
                        <td>
                          <?php if(!empty($property['image_url'])): ?>
                            <img src="images/<?php echo $property['image_url'];?>" class="img-fluid" width="100px;">
                          <?php else: ?>
                            No Image
                          <?php endif; ?>
                        </td>
                        <td>
                          <a href="view_property.php?id=<?php echo $property['id'];?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> View</a>
                          <a href="edit_property.php?id=<?php echo $property['id'];?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                          <a href="delete_property.php?id=<?php echo $property['id'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this property?');"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>  
                    </tbody>
                  </table>  
              </div>
               <div class="pagination">
                  <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <a href="properties.php?page=<?php echo $i; ?>&search=<?php echo $search_query; ?>" class="btn btn-sm <?php if ($i == $page) echo 'btn-primary'; else echo 'btn-default'; ?>"><?php echo $i; ?></a>
                   <?php endfor; ?>
                </div>
              </div>
          </div>
      </section>
    </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">&nbsp;</div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
</body>
</html>
