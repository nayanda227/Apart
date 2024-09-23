<?php
session_start();
include('../koneksi/koneksi.php');

$id = $_GET['id'];
$sql = "SELECT r.id, p.name AS property_name, c.name AS customer_name, r.rating, r.comment, r.review_date
        FROM reviews r
        INNER JOIN properties p ON r.property_id = p.id
        INNER JOIN customers c ON r.customer_id = c.id
        WHERE r.id = '$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);
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
                    <h3><i class="fas fa-eye"></i> View Review</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">View Review</li>
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
                        <th>Property Name</th>
                        <td><?php echo $data['property_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td><?php echo $data['customer_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Rating</th>
                        <td><?php echo $data['rating']; ?></td>
                    </tr>
                    <tr>
                        <th>Comment</th>
                        <td><?php echo $data['comment']; ?></td>
                    </tr>
                    <tr>
                        <th>Review Date</th>
                        <td><?php echo $data['review_date']; ?></td>
                    </tr>
                </table>
                <a href="reviews.php" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
