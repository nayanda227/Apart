<?php
session_start();
include('../koneksi/koneksi.php');

// Ambil id customer dari parameter URL
if(isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    // Query untuk mengambil data customer berdasarkan id
    $sql = "SELECT * FROM customers WHERE id = '$customer_id'";
    $query = mysqli_query($koneksi, $sql);
    $customer = mysqli_fetch_assoc($query);
} else {
    // Jika tidak ada id, redirect ke halaman customers.php atau halaman lainnya
    header("Location: customers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Customer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Customer Details</h3>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> <?php echo $customer['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $customer['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $customer['phone']; ?></p>
                <p><strong>Address:</strong> <?php echo $customer['address']; ?></p>
            </div>
            <div class="card-footer">
                <a href="customers.php" class="btn btn-secondary">Back to Customers</a>
            </div>
        </div>
    </div>
</body>
</html>
