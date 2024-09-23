<?php
session_start();
include('../koneksi/koneksi.php');

// Get the content ID from the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Delete the content from the database
    $sql = "DELETE FROM contents WHERE id = '$id'";
    if (mysqli_query($koneksi, $sql)) {
        $_SESSION['message'] = "Content deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete content: " . mysqli_error($koneksi);
    }
} else {
    $_SESSION['error'] = "Invalid content ID.";
}

header("Location: konten.php");
exit();
?>
