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

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('images/hero_bg_1.jpg');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 text-center" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="text-white">About Us</h1>
                </div>
            </div>
        </div>
    </div>

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM contents");
    $contents = mysqli_fetch_array($query);
    ?>

      <div class="site-section">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="site-section-heading mb-5">
                          <h2 class="mb-5"><?php echo $contents['title']; ?></h2>
                          <p><?php echo $contents['body']; ?></p>
                      </div>
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
