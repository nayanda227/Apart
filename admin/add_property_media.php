<?php
session_start();
include('../koneksi/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $description = $_POST['description'];
    $upload_date = date('Y-m-d');

    $image_url = '';
    if (!empty($_FILES['image']['name'])) {
        $image_url = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image_url);
    }

    $video_url = '';
    if (!empty($_FILES['video']['name'])) {
        $video_url = basename($_FILES['video']['name']);
        move_uploaded_file($_FILES['video']['tmp_name'], "videos/" . $video_url);
    }

    $sql = "INSERT INTO property_images (property_id, image_url, video_url, description, upload_date) 
            VALUES ('$property_id', '$image_url', '$video_url', '$description', '$upload_date')";
    mysqli_query($koneksi, $sql);

    header("Location: properties_media.php");
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
                        <h3><i class="fas fa-images"></i> Add Property Media</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Add Property Media</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="card">
                <div class="card-body">
                    <form action="add_property_media.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="property_id">Property</label>
                            <select class="form-control" id="property_id" name="property_id" required>
                                <?php
                                $properties = mysqli_query($koneksi, "SELECT id, name FROM properties");
                                while ($property = mysqli_fetch_assoc($properties)) {
                                    echo "<option value='{$property['id']}'>{$property['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="video">Video</label>
                            <input type="file" class="form-control" id="video" name="video">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Media</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
