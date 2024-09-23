<?php
include("koneksi/koneksi.php");

// Ambil ID apartemen dari URL
if(isset($_GET['id'])) {
    $apartment_id = $_GET['id'];
    
    // Query database untuk mendapatkan detail apartemen berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM properties WHERE id = $apartment_id");
    
    // Jika data ditemukan
    if ($result = mysqli_fetch_array($query)) {
        $name = $result['name'];
        $price = $result['price'];
        $description = $result['description'];
        $rooms = $result['rooms'];
        $total_area = $result['total_area'];
        $category = $result['category'];
        $launch_date = $result['launch_date'];
        $image_url = $result['image_url'];
    } else {
        // Tampilkan pesan jika data tidak ditemukan
        echo "Apartemen tidak ditemukan.";
        exit(); // Keluar dari script
    }
} else {
    // Tampilkan pesan jika parameter ID tidak ditemukan di URL
    echo "Parameter ID tidak ditemukan.";
    exit(); // Keluar dari script
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("include/head.php"); ?>
</head>
<body>

<div class="site-wrap">
    <div class="site-navbar mt-4">
    <div class="site-wrap">

<div class="site-navbar mt-4">
    <div class="container py-1">
      <div class="row align-items-center">
        <div class="col-8 col-md-8 col-lg-4">
          <h1 class="mb-0"><a href="index.php" class="text-white h2 mb-0"><strong>Apart<span class="text-primary">.</span></strong></a></h1>
        </div>
        <div class="col-4 col-md-4 col-lg-8">
          <nav class="site-navigation text-right text-md-right" role="navigation">
          <?php include_once("include/nav.php");?>
          </nav>
        </div>
       

      </div>
    </div>
  </div>
</div>

    <!-- Hero section -->
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('images/<?php echo $image_url; ?>');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 text-center" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="text-white"><?php echo $name; ?></h1>
                    <p>$<?php echo $price; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Information -->
    <div class="container">
        <div class="featured-property-half d-flex">
            <div class="image" style="background-image: url('images/<?php echo $image_url; ?>')"></div>
            <div class="text">
                <h2>Property Information</h2>
                <p class="mb-5"><?php echo $description; ?></p>
                <ul class="property-list-details mb-5">
                    <li class="text-black">Property Name: <strong class="text-black"><?php echo $name; ?></strong></li>
                    <li>Room: <strong><?php echo $rooms; ?></strong></li>
                    <li>Total Area: <strong><?php echo $total_area; ?></strong></li>
                    <li>Category: <strong><?php echo $category; ?></strong></li>
                    <li>Launch Date: <?php echo $launch_date; ?><strong></strong></li>
                </ul>
                <p><a href="booking.php?id=<?php echo $apartment_id; ?>" class="btn btn-primary px-4 py-3">Booking Now</a></p>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                    <h2 class="mb-5">Browse Apartments</h2>
                </div>
            </div>
            <div class="row">
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM properties");
                while ($result = mysqli_fetch_array($query)) {
                    ?>
                    <div class="col-md-6 col-lg-3 mb-5" data-aos="fade-up" data-aos-delay="100">
                        <a href="apartment-detail.php?id=<?php echo $result['id']; ?>" class="unit-9">
                            <div class="image" style="background-image: url('images/<?php echo $result['image_url']; ?>');"></div>
                            <div class="unit-9-content">
                                <h2><?php echo $result['name']; ?></h2>
                                <span><?php echo $result['price']; ?>/night</span>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="site-section block-13">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                <h2 class="mb-5">Love By Our Customers</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, fugit nam obcaecati fuga itaque deserunt officia, error reiciendis ab quod?</p>
            </div>
        </div>
        <div class="nonloop-block-13 owl-carousel">
            <?php 
            $sql = "SELECT r.id, p.name AS property_name, c.name AS customer_name, r.rating, r.comment, r.review_date
            FROM reviews r
            INNER JOIN properties p ON r.property_id = p.id
            INNER JOIN customers c ON r.customer_id = c.id";
            $query = mysqli_query($koneksi, $sql); 
            while ($results = mysqli_fetch_array($query)){
                ?>
            <div class="text-center p-3 p-md-5 bg-white">
                <div class="text-black">
                    <h3 class="font-weight-light h5"><?php echo $results['customer_name']; ?></h3>
                    <p class="font-italic">&ldquo;<?php echo $results['comment']; ?>&rdquo;</p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>  

    <div class="bg-primary" data-aos="fade">
        <div class="container">
            <div class="row">
                <a href="#" class="col-2 text-center py-4 social-icon d-block"><span class="icon-facebook text-white"></span></a>
                <a href="#" class="col-2 text-center py-4 social-icon d-block"><span class="icon-twitter text-white"></span></a>
                <a href="#" class="col-2 text-center py-4 social-icon d-block"><span class="icon-instagram text-white"></span></a>
                <a href="#" class="col-2 text-center py-4 social-icon d-block"><span class="icon-linkedin text-white"></span></a>
                <a href="#" class="col-2 text-center py-4 social-icon d-block"><span class="icon-pinterest text-white"></span></a>
                <a href="#" class="col-2 text-center py-4 social-icon d-block"><span class="icon-youtube text-white"></span></a>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <?php include_once("include/footer.php"); ?>
    </footer>

</div>
<?php include_once("include/script.php"); ?>
</body>
</html>