<?php
session_start();
include('../koneksi/koneksi.php');

$id = $_GET['id'];
$sql = "DELETE FROM news WHERE id = '$id'";
mysqli_query($koneksi, $sql);

header('Location: news.php?notif=deleteberhasil');
exit;
?>
