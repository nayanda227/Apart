<?php
session_start();
include('../koneksi/koneksi.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string($koneksi, $_POST['title']);
    $body = mysqli_real_escape_string($koneksi, $_POST['body']);
  
    $sql = "INSERT INTO contents (title, body) VALUES ('$title', '$body')";
    if (mysqli_query($koneksi, $sql)) {
        $_SESSION['message'] = "Content added successfully!";
        header("Location: konten.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($koneksi);
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
                    <h3><i class="fas fa-edit"></i> Add Content</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="konten.php">Content Management</a></li>
                        <li class="breadcrumb-item active">Add Content</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Content Form</h3>
                <div class="card-tools">
                    <a href="konten.php" class="btn btn-sm btn-warning float-right">
                    <i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                </div>
            </div>
            <form class="form-horizontal" action="add_content.php" method="post">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="body" class="col-sm-3 col-form-label">Body</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="body" id="body" rows="12" required></textarea>
                        </div>
                    </div>     
                </div>
                <div class="card-footer">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Save</button>
                    </div>  
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
