<?php
session_start();
include('../koneksi/koneksi.php');

if (isset($_GET['id'])) {
    $media_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $property_id = $_POST['property_id'];
        $description = $_POST['description'];
        $upload_date = $_POST['upload_date'];

        $existing_image = $_POST['existing_image'];
        $existing_video = $_POST['existing_video'];

        if ($_FILES['media']['size'] > 0) {
            // Check file type
            $file_type = pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);
            if (in_array($file_type, array('jpg', 'jpeg', 'png', 'gif'))) {
                // It's an image
                $image_url = basename($_FILES['media']['name']);
                $target_dir = "images/";
                $target_file = $target_dir . $image_url;
                move_uploaded_file($_FILES['media']['tmp_name'], $target_file);
                $video_url = '';
            } elseif (in_array($file_type, array('mp4', 'avi', 'mov'))) {
                // It's a video
                $video_url = basename($_FILES['media']['name']);
                $target_dir = "videos/";
                $target_file = $target_dir . $video_url;
                move_uploaded_file($_FILES['media']['tmp_name'], $target_file);
                $image_url = '';
            } else {
                // Unsupported file type, handle error
                echo "Unsupported file type!";
                exit;
            }
        } else {
            // No new file uploaded, use existing values
            $image_url = $existing_image;
            $video_url = $existing_video;
        }

        $sql = "UPDATE property_images 
                SET property_id='$property_id', image_url='$image_url', video_url='$video_url', description='$description', upload_date='$upload_date' 
                WHERE id='$media_id'";
        mysqli_query($koneksi, $sql);

        header("Location: properties_media.php");
    }

    $sql = "SELECT * FROM property_images WHERE id='$media_id'";
    $query = mysqli_query($koneksi, $sql);
    $media = mysqli_fetch_assoc($query);
} else {
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
                        <h3><i class="fas fa-edit"></i> Edit Property Media</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Edit Property Media</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="card">
                <div class="card-body">
                    <form action="edit_property_media.php?id=<?php echo $media['id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Property</label>
                            <select name="property_id" class="form-control" required>
                                <?php
                                $sql_properties = "SELECT id, name FROM properties";
                                $query_properties = mysqli_query($koneksi, $sql_properties);
                                while ($property = mysqli_fetch_assoc($query_properties)) {
                                    $selected = $property['id'] == $media['property_id'] ? 'selected' : '';
                                    echo "<option value='{$property['id']}' $selected>{$property['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Media</label>
                            <input type="file" name="media" class="form-control">
                            <input type="hidden" name="existing_image" value="<?php echo $media['image_url']; ?>">
                            <input type="hidden" name="existing_video" value="<?php echo $media['video_url']; ?>">

                            <br>
                            <?php if ($media['image_url']): ?>
                                <img src="images/<?php echo $media['image_url']; ?>" width="100px">
                            <?php elseif ($media['video_url']): ?>
                                <video width="320" height="240" controls>
                                    <source src="videos/<?php echo $media['video_url']; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required><?php echo $media['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Date</label>
                            <input type="date" name="upload_date" class="form-control" value="<?php echo $media['upload_date']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
