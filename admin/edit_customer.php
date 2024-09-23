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

// Proses update customer jika form disubmit
if(isset($_POST['update_customer'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Query untuk update data customer
    $sql_update = "UPDATE customers SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = '$customer_id'";
    $query_update = mysqli_query($koneksi, $sql_update);

    if($query_update) {
        // Redirect ke halaman view_customer.php setelah berhasil update
        header("Location: view_customer.php?id=$customer_id");
        exit();
    } else {
        echo "Failed to update customer.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Edit Customer</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $customer['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $customer['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $customer['phone']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"><?php echo $customer['address']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_customer">Update</button>
                    <a href="view_customer.php?id=<?php echo $customer['id']; ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
