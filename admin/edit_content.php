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
    
    if (!$content) {
        $_SESSION['error'] = "Content not found.";
        header("Location: content_management.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid content ID.";
    header("Location: konten.php");
    exit();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($koneksi, $_POST['title']);
    $body = mysqli_real_escape_string($koneksi, $_POST['body']);

    if (empty($title) || empty($body)) {
        $_SESSION['error'] = "Title and body cannot be empty.";
    } else {
        $sql = "UPDATE contents SET title = '$title', body = '$body' WHERE id = '$id'";
        if (mysqli_query($koneksi, $sql)) {
            $_SESSION['message'] = "Content updated successfully.";
            header("Location: konten.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to update content: " . mysqli_error($koneksi);
        }
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
                    <h3><i class="fas fa-edit"></i> Edit Content</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="content_management.php">Content Management</a></li>
                        <li class="breadcrumb-item active">Edit Content</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
                ?>
                <form action="edit_content.php?id=<?php echo $id; ?>" method="post">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $content['title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea name="body" class="form-control" required><?php echo $content['body']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Update</button>
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
