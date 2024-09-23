<?php
session_start();
include('../koneksi/koneksi.php');

$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
head>
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
                    <h3><i class="fas fa-eye"></i> View News</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">View News</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td><?php echo $data['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td><?php echo $data['title']; ?></td>
                    </tr>
                    <tr>
                        <th>Content</th>
                        <td><?php echo $data['content']; ?></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><?php echo $data['type']; ?></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><?php echo $data['date']; ?></td>
                    </tr>
                </table>
                <a href="news.php" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
