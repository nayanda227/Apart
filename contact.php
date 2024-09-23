<?php
include("koneksi/koneksi.php");

$status = $message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses form jika method POST
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Email tujuan
    $to = "youremail@domain.com";
    
    // Header email
    $headers = "From: $email \r\n";
    $headers .= "Reply-To: $email \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    // Isi email
    $email_content = "
    <html>
    <body>
        <h2>Contact Form Submission</h2>
        <p><strong>Full Name:</strong> $fullname</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>$message</p>
    </body>
    </html>
    ";
    
    // Kirim email
    if (mail($to, $subject, $email_content, $headers)) {
        $status = "success";
        $message = "Your message has been sent successfully!";
    } else {
        $status = "error";
        $message = "Failed to send message. Please try again.";
    }
}

// Query untuk mengambil konten 'contact_us'
$query = mysqli_query($koneksi, "SELECT * FROM contents WHERE 'Contact'");
if (!$query) {
    die('SQL Error: ' . mysqli_error($koneksi));
}

// Ambil hasil query sebagai array asosiatif
$contents = mysqli_fetch_array($query);
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
  </div> <!-- .site-mobile-menu -->

  <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('images/hero_bg_1.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-7 text-center" data-aos="fade-up" data-aos-delay="400">
          <h1 class="text-white">Contact Us</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section border-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-7 mb-5">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="contact-form">
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="font-weight-bold" for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="subject">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter Subject" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Say hello to us" required></textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-4">
              </div>
            </div>
          </form>
          <?php if (!empty($status)): ?>
          <div class="alert alert-<?php echo $status; ?>" role="alert">
            <?php echo $message; ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="col-lg-4 ml-auto">
          <div class="p-4 mb-3 bg-white">
            <h3 class="h5 text-black mb-3">Contact Info</h3>
            <p class="mb-0 font-weight-bold text-black">Address</p>
            <p class="mb-4 text-black">203 Fake St. Mountain View, San Francisco, California, USA</p>

            <p class="mb-0 font-weight-bold text-black">Phone</p>
            <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

            <p class="mb-0 font-weight-bold text-black">Email Address</p>
            <p class="mb-0"><a href="#">apart@domain.com</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="site-section block-13 bg-light">
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
      <?php include_once("include/footer.php");?>
    </footer>

  </div>
  <?php include_once("include/script.php");?>
  </body>
</html>