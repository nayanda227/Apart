<?php
session_start();
include('../koneksi/koneksi.php');

// Get the content ID from the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Fetch the content from the database
    $sql = "SELECT * FROM contents WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    $content = mysqli_fetch_assoc($result);
} else {
    $_SESSION['error'] = "Invalid content ID.";
    header("Location: konten.php");
    exit();
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
                    <h3><i class="fas fa-newspaper"></i> View Content</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="content_management.php">Konten</a></li>
                        <li class="breadcrumb-item active">View Content</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <?php if ($content): ?>
                    <h3><?php echo $content['title']; ?></h3>
                    <p><?php echo nl2br($content['body']); ?></p>
                    <p><strong>Created At:</strong> <?php echo $content['created_at']; ?></p>
                    <p><strong>Admin ID:</strong> <?php echo $content['admin_id']; ?></p>
                <?php else: ?>
                    <p>Content not found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
