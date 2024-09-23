<?php
session_start();
include('../koneksi/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $property_id = $_POST['property_id'];
    $check_in = $_POST['check_in'];
    $nights = $_POST['nights'];
    $total_price = $_POST['total_price'];

    $sql = "INSERT INTO reservations (customer_id, property_id, check_in, nights, total_price) VALUES ('$customer_id', '$property_id', '$check_in', '$nights', '$total_price')";
    mysqli_query($koneksi, $sql);

    header('Location: reservations.php?notif=addberhasil');
    exit;
}

$sql_customers = "SELECT id, name FROM customers";
$query_customers = mysqli_query($koneksi, $sql_customers);

$sql_properties = "SELECT id, name FROM properties";
$query_properties = mysqli_query($koneksi, $sql_properties);
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
                    <h3><i class="fas fa-plus"></i> Add Reservation</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Add Reservation</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="add_reservation.php" method="post">
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control">
                            <?php while ($customer = mysqli_fetch_assoc($query_customers)): ?>
                                <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="property_id">Property</label>
                        <select name="property_id" id="property_id" class="form-control">
                            <?php while ($property = mysqli_fetch_assoc($query_properties)): ?>
                                <option value="<?php echo $property['id']; ?>"><?php echo $property['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="check_in">Check-In Date</label>
                        <input type="date" name="check_in" id="check_in" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nights">Nights</label>
                        <input type="number" name="nights" id="nights" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Price</label>
                        <input type="number" name="total_price" id="total_price" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Reservation</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body
