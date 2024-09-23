<?php
session_start();
include('../koneksi/koneksi.php');

if (!isset($_GET['id'])) {
    header("Location: property_media.php");
    exit;
}

$id = $_GET['id'];
$sql = "DELETE FROM property_images WHERE id = '$id'";
mysqli_query($koneksi, $sql);

header("Location: properties_media.php");
?>
