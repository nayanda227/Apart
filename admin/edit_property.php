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

// Fetch property information
$id_property = $_GET['id'];
$sql_property = "SELECT `name`, `rooms`, `total_area`, `price`, `category`, `launch_date`, `description`, `image_url` FROM `properties` WHERE `id`='$id_property'";
$query_property = mysqli_query($koneksi, $sql_property);
$data_property = mysqli_fetch_assoc($query_property);

// Handle form submission
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $rooms = $_POST['rooms'];
    $total_area = $_POST['total_area'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $launch_date = $_POST['launch_date'];
    $description = $_POST['description'];
    $image_url = $_FILES['image']['name'];

    // Handle file upload if a new image is uploaded
    if (!empty($image_url)) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($image_url);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        $image_url = $data_property['image_url'];
    }

    // Update property in the database
    $sql_update = "UPDATE `properties` SET `name`='$name', `rooms`='$rooms', `total_area`='$total_area', `price`='$price', `category`='$category', `launch_date`='$launch_date', `description`='$description', `image_url`='$image_url' WHERE `id`='$id_property'";
    mysqli_query($koneksi, $sql_update);
    header("Location: properties.php?notif=updateberhasil");
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
            <h3><i class="fas fa-edit"></i> Edit Property</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="properties.php">Properties</a></li>
              <li class="breadcrumb-item active">Edit Property</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Property Name</label>
              <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($data_property['name']); ?>" required>
            </div>
            <div class="form-group">
              <label for="rooms">Rooms</label>
              <input type="number" class="form-control" id="rooms" name="rooms" value="<?php echo htmlspecialchars($data_property['rooms']); ?>" required>
            </div>
            <div class="form-group">
              <label for="total_area">Total Area (sqm)</label>
              <input type="number" class="form-control" id="total_area" name="total_area" value="<?php echo htmlspecialchars($data_property['total_area']); ?>" required>
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($data_property['price']); ?>" required>
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($data_property['category']); ?>" required>
            </div>
            <div class="form-group">
              <label for="launch_date">Launch Date</label>
              <input type="date" class="form-control" id="launch_date" name="launch_date" value="<?php echo htmlspecialchars($data_property['launch_date']); ?>" required>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($data_property['description']); ?></textarea>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control" id="image" name="image">
              <?php if(!empty($data_property['image_url'])): ?>
                <img src="images/<?php echo $data_property['image_url'];?>" class="img-fluid mt-2" width="100px;">
              <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Property</button>
          </form>
        </div>
        <div class="card-footer clearfix">&nbsp;</div>
      </div>
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
