<?php 
session_start();
include('../koneksi/koneksi.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $rooms = $_POST['rooms'];
    $total_area = $_POST['total_area'];
    $price = $_POST['price']; 
    $category = $_POST['category'];
    $launch_date = $_POST['launch_date'];
    $description = $_POST['description'];
    // Handle image upload
    if(!empty($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "images/$image_name");
    } else {
        $image_name = null;
    }

    $sql = "INSERT INTO `properties` (`name`, `rooms`, `total_area`, `price`, `category`, `launch_date`, `description`, `image_url`) 
            VALUES ('$name', '$rooms', '$total_area', '$price', '$category', '$launch_date', '$description', '$image_name')";
    
    if(mysqli_query($koneksi, $sql)){
        header("Location: properties.php?notif=addberhasil");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
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

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-building"></i> Add Property</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="properties.php">Properties</a></li>
              <li class="breadcrumb-item active">Add Property</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Property</h3>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Property Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="rooms">Rooms</label>
                        <input type="number" class="form-control" id="rooms" name="rooms" required>
                    </div>
                    <div class="form-group">
                        <label for="total_area">Total Area (sqm)</label>
                        <input type="number" class="form-control" id="total_area" name="total_area" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <div class="form-group">
                        <label for="launch_date">Launch Date</label>
                        <input type="date" class="form-control" id="launch_date" name="launch_date" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add Property</button>
                </div>
            </form>
        </div>
    </section>
</div>
<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
