<?php
// Panggil file koneksi database
include("koneksi/koneksi.php");

// Ambil data properti untuk ditampilkan pada tur
$query = mysqli_query($koneksi, "SELECT * FROM properties");

// Periksa apakah terdapat properti
if (mysqli_num_rows($query) > 0) {
    // Tampilkan header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Virtual Tour</title>
    <?php include_once("include/head.php"); ?>
</head>
<body>
<div class="site-wrap">

<div class="site-navbar mt-4">
    <div class="container py-1">
        <div class="row align-items-center">
            <div class="col-8 col-md-8 col-lg-4">
                <h1 class="mb-0"><a href="index.php" class="text-white h2 mb-0"><strong>Apart<span class="text-primary">.</span></strong></a></h1>
            </div>
            <div class="col-4 col-md-4 col-lg-8">
                <nav class="site-navigation text-right text-md-right" role="navigation">
                    <?php include_once("include/nav.php"); ?>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>
<div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div> <!-- .site-mobile-menu -->
<div class="site-blocks-cover overlay" style="background-image: url('images/hero_bg_2.jpg');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
            </div>
        </div>
    </div>
</div>
    <!-- Bagian konten untuk menampilkan tur virtual -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Virtual Tour</h2>
            </div>
        </div>
        <div class="row">
            <?php
            // Looping untuk menampilkan tur virtual setiap properti
            while ($property = mysqli_fetch_assoc($query)) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Tampilkan gambar properti -->
                    <img src="images/<?php echo $property['image_url']; ?>" class="card-img-top" alt="Property Image">
                    <div class="card-body">
                        <!-- Tampilkan nama properti -->
                        <h5 class="card-title"><?php echo $property['name']; ?></h5>
                        <!-- Tampilkan deskripsi properti -->
                        <p class="card-text"><?php echo $property['description']; ?></p>
                        <!-- Tampilkan tombol untuk pesan sekarang -->
                        <a href="booking.php?id=<?php echo $property['id']; ?>" class="btn btn-success">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Tampilkan footer -->
    <?php include_once("include/footer.php"); ?>

    <!-- Tambahkan file script JavaScript atau script lain yang diperlukan di sini -->
    <?php include_once("include/script.php"); ?>
</body>
</html>

<?php
} else {
    // Tampilkan pesan jika tidak ada properti yang tersedia
    echo "No properties available.";
}
?>
