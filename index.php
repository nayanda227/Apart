<?php
include("koneksi/koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
</div> 
<!-- .site-mobile-menu -->
<div class="site-blocks-cover overlay" style="background-image: url('images/hero_bg_2.jpg');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
                <h1 class="mb-4">Excellent Space For Your Next Home</h1>
                <p class="mb-5">1105 Madison Plaza Suite 120 Chesapeake, CA, California</p>
                <!--button-->
                <p><a href="tour.php" class="btn btn-primary px-5 py-3">Take a Tour</a></p>
            </div>
        </div>
    </div>
</div>
<!-- keterangan gambar dan informasi apartmen dengan slide -->
<div id="property-carousel" class="carousel slide" data-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <!---mengklasifikasikan data apa yang diambil dari database-->
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM properties");
            $first = true;
            while ($result = mysqli_fetch_array($query)) {
                $activeClass = $first ? 'active' : '';
                $first = false;
            ?>
            <!--mengambil data properties berupa gambar dan deskripsi dari database-->
            <div class="carousel-item <?php echo $activeClass; ?>">
                <div class="featured-property-half d-flex">
                    <div class="image" style="background-image: url('images/<?php echo $result['image_url']; ?>')"></div>
                    <div class="text">
                        <h2>Property Information</h2>
                        <p class="mb-5"><?php echo $result['description']; ?></p>
                        <ul class="property-list-details mb-5">
                            <li class="text-black">Property Name: <strong class="text-black"><?php echo $result['name']; ?></strong></li>
                            <li>Room: <strong><?php echo $result['rooms']; ?></strong></li>
                            <li>Total Area: <strong><?php echo $result['total_area']; ?></strong></li>
                            <li>Category: <strong><?php echo $result['category']; ?></strong></li>
                            <li>Launch Date: <?php echo $result['launch_date']; ?><strong></strong></li>
                        </ul>
                        <!-- klik yang mengarahkan ke apartemen detail sesuai dengan apa yang diklik-->
                        <p><a href="apartment-detail.php?id=<?php echo $result['id']; ?>" class="btn btn-primary px-4 py-3">Get Details</a></p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <!--tombol next dan previous-->
        <a class="carousel-control-prev" href="#property-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#property-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto" data-aos="fade-up">
                    <h2 class="mb-5">Browse Apartments</h2>
                </div>
            </div>
            <!--mengkaitkan koneksi sql tabel properties dengan limit 4 -->
            <div class="row">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM properties LIMIT 4");
            while ($results = mysqli_fetch_array($query)){
            ?>   
             <!--mengkaitkan koneksi sql tabel properties dengan kolom yang ditampilkan img dan kategori -->       
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <a href="apartment-detail.php?id=<?php echo $results['id']; ?>" class="unit-9">
                        <div class="image" style="background-image: url('images/<?php echo $results['image_url']; ?>');"></div>
                        <div class="unit-9-content">
                            <h2><?php echo $results['name']; ?></h2>
                            <span><?php echo $results['category']; ?></span>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
            <!--button yang mengarahkan ke halaman apartemen-->
                <div class="col-md-12 text-center mt-5" data-aos="fade-up">
                    <a href="apartments.php" class="btn btn-primary">Browse All Apartments</a>
                </div>
            </div>
        </div>
    </div>

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
        $query = mysqli_query($koneksi, "SELECT property_images.image_url, properties.name, property_images.description, properties.id FROM property_images JOIN properties ON property_images.property_id=properties.id LIMIT 4");
        while ($results = mysqli_fetch_array($query)){
        ?>          
            <div class="col-md-2 col-lg-6" data-aos="fade-up" data-aos-delay="100">
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

<div class="site-section block-13">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                <h2 class="mb-5">Love By Our Customers</h2>
                <p>Some people trust apart for the dream living</p>
            </div>
        </div>
        <!--mengambil data dari tabel review -->
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

<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto" data-aos="fade-up">
                <h2 class="mb-5">News &amp; Events</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, fugit nam obcaecati fuga itaque deserunt officia, error reiciendis ab quod?</p>
            </div>
        </div>
        
        <div class="row">
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM news LIMIT 3");
        while ($results = mysqli_fetch_array($query)){
        ?>          
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 bg-white shadow-sm">
                    <span class="d-block text-secondary small text-uppercase"><?php echo $results['date']; ?></span>
                    <h2 class="h5 text-black mb-3"><a href="single.php"><?php echo $results['title']; ?></a></h2>
                    <span class="d-block text-secondary small text-uppercase">Type : <?php echo $results['type']; ?></span>
                    <p><?php echo $results['content']; ?></p>            
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
        <?php include_once("include/footer.php");?>
    </footer>

    </div>
    <?php include_once("include/script.php");?>
    <script>

    setInterval(function() {
            $('.carousel').carousel('next');
        }, 5000);
    </script>

</body>
</html>