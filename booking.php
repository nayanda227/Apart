<?php
include("koneksi/koneksi.php");

// Periksa apakah ID properti ada dalam query string
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Ambil detail properti berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM properties WHERE id='$property_id'");
    $property = mysqli_fetch_assoc($query);

    if (!$property) {
        echo "Properti tidak ditemukan.";
        exit;
    }
} else {
    echo "ID properti tidak disediakan.";
    exit;
}

// Jika form dikirimkan, proses data pemesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $check_in = $_POST['check_in'];
    $nights = $_POST['nights'];
    $price_per_night = $property['price']; // Ambil harga per malam dari properti
    $total_price = $nights * $price_per_night; // Hitung total harga

    // Mulai transaksi
    mysqli_begin_transaction($koneksi);

    try {
        // Simpan data pelanggan ke tabel customers
        $customer_query = "INSERT INTO customers (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        if (!mysqli_query($koneksi, $customer_query)) {
            throw new Exception('Error: ' . mysqli_error($koneksi));
        }

        // Ambil ID pelanggan yang baru saja dimasukkan
        $customer_id = mysqli_insert_id($koneksi);

        // Simpan data pemesanan ke tabel reservations
        $reservation_query = "INSERT INTO reservations (property_id, customer_id, check_in, nights, total_price) VALUES ('$property_id', '$customer_id', '$check_in', '$nights', '$total_price')";
        if (!mysqli_query($koneksi, $reservation_query)) {
            throw new Exception('Error: ' . mysqli_error($koneksi));
        }

        // Commit transaksi
        mysqli_commit($koneksi);

        // Set a flag to indicate success
        $booking_success = true;
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        mysqli_rollback($koneksi);
        echo "Terjadi kesalahan saat memproses pemesanan: " . $e->getMessage();
        $booking_success = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking Properti</title>
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

<div class="site-blocks-cover overlay" style="background-image: url('images/hero_bg_2.jpg');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
                <h1 class="text-white"><?php echo $property['name']; ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center mb-4">Formulir Pemesanan</h2>
            <form action="booking.php?id=<?php echo $property_id; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="check_in">Tanggal Check-in</label>
                    <input type="date" class="form-control" id="check_in" name="check_in" required>
                </div>
                <div class="form-group">
                    <label for="nights">Jumlah Malam</label>
                    <input type="number" class="form-control" id="nights" name="nights" required>
                </div>
                <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
            </form>
        </div>
    </div>
</div>

<!-- Tampilkan footer -->
<?php include_once("include/footer.php"); ?>

<!-- Tambahkan file script JavaScript atau script lain yang diperlukan di sini -->
<?php include_once("include/script.php"); ?>
<!-- Notifikasi Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Pemesanan Berhasil!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Terima kasih telah melakukan pemesanan. Kami akan menghubungi Anda segera untuk konfirmasi lebih lanjut.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php if (isset($booking_success) && $booking_success): ?>
<script>
    $(document).ready(function() {
        $('#successModal').modal('show');
    });
</script>
<?php endif; ?>
</body>
</html>
