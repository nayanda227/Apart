<?php
include("koneksi/koneksi.php"); // Include database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("include/head.php"); ?> <!-- Include head section -->
</head>
<body>

<div class="site-wrap">

    <!-- Navbar -->
    <div class="site-navbar mt-4">
        <div class="container py-1">
            <div class="row align-items-center">
                <div class="col-8 col-md-8 col-lg-4">
                    <h1 class="mb-0"><a href="index.php" class="text-white h2 mb-0"><strong>Apart<span class="text-primary">.</span></strong></a></h1>
                </div>
                <div class="col-4 col-md-4 col-lg-8">
                    <nav class="site-navigation text-right text-md-right" role="navigation">
                        <?php include_once("include/nav.php"); ?> <!-- Include navigation -->
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <!-- Cover Section -->
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('images/hero_bg_1.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 text-center" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="text-white">Apartments</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Browse Apartments Section -->
    <div class="site-section">
    <div class="container">
        <div class="row">
            <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                <h2 class="mb-5">Browse Apartments</h2>
            </div>
        </div>
        <div class="row">
            <?php
            // Membuat SQL query saat difilter berdasar kategori atau kamar
            $sql = "SELECT * FROM properties";
            if(isset($_GET['category'])) {
                $category = $_GET['category'];
                $sql .= " WHERE category = '$category'";
            }
            if(isset($_GET['rooms']) && !empty($_GET['rooms'])) {
                $rooms = $_GET['rooms'];
                if(strpos($sql, 'WHERE') === false) {
                    $sql .= " WHERE rooms = $rooms";
                } else {
                    $sql .= " AND rooms = $rooms";
                }
            }
            $query = mysqli_query($koneksi, $sql);

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


    <!-- Featured Apartments Section -->
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto" data-aos="fade-up">
                    <h2 class="mb-5">Featured Apartments</h2>
                    <p>Lets booking now and we give you surprise</p>
                </div>
            </div>
            <div class="row">
                <?php
                // Reset previous query
                mysqli_data_seek($query, 0);

                while ($results = mysqli_fetch_array($query)) {
                    ?>
                    <div class="col-md-6 col-lg-3 mb-5" data-aos="fade-up" data-aos-delay="100">
                        <a href="apartment-detail.php?id=<?php echo $results['id']; ?>" class="unit-9">
                            <div class="image" style="background-image: url('images/<?php echo $results['image_url']; ?>');"></div>
                            <div class="unit-9-content">
                                <h2><?php echo $results['name']; ?></h2>
                                <span><?php echo $results['description']; ?></span>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Customer Reviews Section -->
    <div class="site-section block-13">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                    <h2 class="mb-5">Love By Our Customers</h2>
                    <p>Some people trust apart for the dream living</p></p>
                </div>
            </div>
            <div class="nonloop-block-13 owl-carousel">
                <?php
                $sql = "SELECT r.id, p.name AS property_name, c.name AS customer_name, r.rating, r.comment, r.review_date
                FROM reviews r
                INNER JOIN properties p ON r.property_id = p.id
                INNER JOIN customers c ON r.customer_id = c.id";
                $query = mysqli_query($koneksi, $sql);
                while ($results = mysqli_fetch_array($query)) {
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

    <!-- Social Media Links Section -->
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

    <!-- Footer Section -->
    <footer class="site-footer">
        <?php include_once("include/footer.php"); ?>
    </footer>

</div>

<!-- Scripts Section -->
<?php include_once("include/script.php"); ?>
</body>
</html>
