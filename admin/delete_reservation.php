<?php
session_start();
include('../koneksi/koneksi.php');

if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    $sql = "DELETE FROM reservations WHERE id = '$reservation_id'";
    mysqli_query($koneksi, $sql);

    header("Location: reservations.php");
} else {
    header("Location: reservations.php");
}
?>
