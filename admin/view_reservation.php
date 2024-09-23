<?php
session_start();
include('../koneksi/koneksi.php');

$id = $_GET['id'];
$sql = "SELECT r.id, c.name AS customer_name, p.name AS property_name, r.check_in, r.nights, r.total_price
        FROM reservations r
        LEFT JOIN customers c ON r.customer_id = c.id
        LEFT JOIN properties p ON r.property_id = p.id
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
                    <h3><i class="fas fa-eye"></i> View Reservation</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">View Reservation</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="customer_name">Customer</label>
                    <input type="text" id="customer_name" class="form-control" value="<?php echo $data['customer_name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="property_name">Property</label>
                    <input type="text" id="property_name" class="form-control" value="<?php echo $data['property_name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="check_in">Check-In Date</label>
                    <input type="date" id="check_in" class="form-control" value="<?php echo $data['check_in']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nights">Nights</label>
                    <input type="number" id="nights" class="form-control" value="<?php echo $data['nights']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="total_price">Total Price</label>
                    <input type="number" id="total_price" class="form-control" value="<?php echo $data['total_price']; ?>" readonly>
                </div>
                <a href="reservations.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
