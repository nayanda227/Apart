<?php
session_start();
include('../koneksi/koneksi.php');
$id_user = $_SESSION['id_user'];

// Check if the user is logged in
if (!isset($id_user)) {
    header("Location: login.php");
    exit();
}

// Get the property ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the property details to get the image URL
    $sql_property = "SELECT `image_url` FROM `properties` WHERE `id`='$id'";
    $query_property = mysqli_query($koneksi, $sql_property);
    $property = mysqli_fetch_assoc($query_property);

    if ($property) {
        // Delete the property record from the database
        $sql_delete = "DELETE FROM `properties` WHERE `id`='$id'";
        if (mysqli_query($koneksi, $sql_delete)) {
            // Delete the image file from the server
            if (!empty($property['image_url']) && file_exists("images/" . $property['image_url'])) {
                unlink("images/" . $property['image_url']);
            }
            header("Location: properties.php?notif=deleteberhasil");
            exit();
        } else {
            echo "Error: " . $sql_delete . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Property not found.";
    }
} else {
    echo "Invalid request.";
}
?>
