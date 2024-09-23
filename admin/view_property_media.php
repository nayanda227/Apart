<?php
session_start();
include('../koneksi/koneksi.php');

if (!isset($_GET['id'])) {
    header("Location: property_media.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT pi.id, p.name AS property_name, pi.image_url, pi.video_url, pi.description, pi.upload_date 
        FROM property_images pi
        LEFT JOIN properties p ON pi.property_id = p.id
        WHERE pi.id = '$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: properties_media.php");
    exit;
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
                        <h3><i class="fas fa-images"></i> View Property Media</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">View Property Media</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="property_name">Property Name</label>
                        <input type="text" class="form-control" id="property_name" value="<?php echo $data['property_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <?php if (!empty($data['image_url'])): ?>
                            <img src="images/<?php echo $data['image_url']; ?>" width="100%">
                        <?php else: ?>
                            <p>No Image</p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="video">Video</label>
                        <?php if (!empty($data['video_url'])): ?>
                            <video width="100%" controls>
                                <source src="videos/<?php echo $data['video_url']; ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php else: ?>
                            <p>No Video</p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3" readonly><?php echo $data['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="upload_date">Upload Date</label>
                        <input type="text" class="form-control" id="upload_date" value="<?php echo $data['upload_date']; ?>" readonly>
                    </div>
                    <a href="properties_media.php" class="btn btn-primary">Back</a>
                </div>
            </div>
        </section>
    </div>

    <?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
