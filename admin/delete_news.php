<?php
session_start();
include('../koneksi/koneksi.php');

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Delete the news from the database
    $sql = "DELETE FROM news WHERE id = '$id'";
    if (mysqli_query($koneksi, $sql)) {
        $_SESSION['message'] = "News deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete news: " . mysqli_error($koneksi);
    }
} else {
    $_SESSION['error'] = "Invalid news ID.";
}

// Redirect back to the news management page
header("Location: news.php");
exit();
?>
