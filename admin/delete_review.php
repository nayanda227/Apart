<?php
session_start();
include('../koneksi/koneksi.php');

$id = $_GET['id'];
$sql = "DELETE FROM reviews WHERE id = '$id'";
mysqli_query($koneksi, $sql);

header('Location: reviews.php?notif=deleteberhasil');
exit;
?>
