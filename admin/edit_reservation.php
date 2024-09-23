<?php
session_start();
include('../koneksi/koneksi.php');

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $property_id = $_POST['property_id'];
    $check_in = $_POST['check_in'];
    $nights = $_POST['nights'];
    $total_price = $_POST['total_price'];

    $sql = "UPDATE reservations SET customer_id='$customer_id', property_id='$property_id', check_in='$check_in', nights='$nights', total_price='$total_price' WHERE id='$id'";
    mysqli_query($koneksi, $sql);

    header('Location: reservations.php?notif=editberhasil');
    exit;
}

$sql = "SELECT * FROM reservations WHERE id='$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

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
                    <h3><i class="fas fa-edit"></i> Edit Reservation</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Edit Reservation</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="edit_reservation.php?id=<?php echo $id; ?>" method="post">
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control">
                            <?php while ($customer = mysqli_fetch_assoc($query_customers)): ?>
                                <option value="<?php echo $customer['id']; ?>" <?php if ($customer['id'] == $data['customer_id']) echo 'selected'; ?>><?php echo $customer['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="property_id">Property</label>
                        <select name="property_id" id="property_id" class="form-control">
                            <?php while ($property = mysqli_fetch_assoc($query_properties)): ?>
                                <option value="<?php echo $property['id']; ?>" <?php if ($property['id'] == $data['property_id']) echo 'selected'; ?>><?php echo $property['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="check_in">Check-In Date</label>
                        <input type="date" name="check_in" id="check_in" class="form-control" value="<?php echo $data['check_in']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nights">Nights</label>
                        <input type="number" name="nights" id="nights" class="form-control" value="<?php echo $data['nights']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Price</label>
                        <input type="number" name="total_price" id="total_price" class="form-control" value="<?php echo $data['total_price']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
