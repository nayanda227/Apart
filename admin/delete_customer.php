<?php
session_start();
include('../koneksi/koneksi.php');

// Ambil id customer dari parameter URL
if(isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    // Query untuk menghapus data customer berdasarkan id
    $sql_delete = "DELETE FROM customers WHERE id = '$customer_id'";
    $query_delete = mysqli_query($koneksi, $sql_delete);

    if($query_delete) {
        // Redirect ke halaman customers.php setelah berhasil delete
        header("Location: customers.php");
        exit();
    } else {
        echo "Failed to delete customer.";
    }
} else {
    // Jika tidak ada id, redirect ke halaman customers.php atau halaman lainnya
    header("Location: customers.php");
    exit();
}
?>
