<?php
// Include database connection
include_once("koneksi/koneksi.php");

// Check if news ID is provided in query string
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $koneksi->prepare("SELECT id, title, content, date FROM news WHERE id = ?");
    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query was successful
    if ($result === false) {
        echo "Error: " . $koneksi->error;
        exit;
    }

    // Fetch news details as associative array
    $news_item = $result->fetch_assoc();

    // Check if news item exists
    if (!$news_item) {
        echo "<p>News item not found.</p>";
    } else {
        // Display news content dynamically
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

            <div class="site-blocks-cover overlay" style="background-image: url('images/hero_bg_2.jpg');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2 class="mb-4"><?php echo htmlspecialchars($news_item['title']); ?></h2>
                            <p><?php echo nl2br(htmlspecialchars($news_item['content'])); ?></p>
                            <div class="pt-5">
                                <p>Published Date: <?php echo date("M jS, Y", strtotime($news_item['date'])); ?></p>
                            </div>
                        </div>
                        
                        <!-- Sidebar Section -->
                        <div class="col-md-3 ml-auto">
                            <div class="mb-5">
                                <h3 class="h5 text-white mb-3">Search</h3>
                                <form action="#" method="post">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Section -->
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
            <footer class="site-footer bg-light">
                <?php include_once("include/footer.php"); ?>
            </footer>
        </div>
        <?php include_once("include/script.php"); ?>
        </body>
        </html>
        <?php
    }
    $stmt->close();
} else {
    echo "<p>No news ID provided.</p>";
}
$koneksi->close();
?>
