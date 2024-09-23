<?php
include_once("koneksi/koneksi.php");

// Pagination variables
$items_per_page = 6; // Number of news items per page
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page, default is 1

// Calculate offset for SQL query
$offset = ($current_page - 1) * $items_per_page;

// Filter variable
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($koneksi, $_GET['filter']) : '';

// Modify SQL query based on filter
$sql = "SELECT id, title, content, type, date FROM news";
if (!empty($filter)) {
    $sql .= " WHERE type = '$filter'";
}
$sql .= " ORDER BY date DESC LIMIT $offset, $items_per_page";

// Fetch news data from database with pagination and filter
$result = mysqli_query($koneksi, $sql);

// Check if the query was successful
if ($result === false) {
    echo "Error: " . mysqli_error($koneksi);
    exit;
}

// Fetch all news items as an associative array
$news_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Count total number of news items (for pagination)
$total_sql = "SELECT COUNT(*) AS total FROM news";
if (!empty($filter)) {
    $total_sql .= " WHERE type = '$filter'";
}
$total_result = mysqli_query($koneksi, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_pages = ceil($total_row['total'] / $items_per_page);
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

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('images/hero_bg_1.jpg');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 text-center" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white">News &amp; Events</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter section -->
    <div class="container mt-5">
        <ul class="nav nav-tabs justify-content-center mb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?php echo empty($filter) ? 'active' : ''; ?>" id="all-tab" href="news.php" role="tab" aria-controls="all" aria-selected="true">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($filter == 'event') ? 'active' : ''; ?>" id="event-tab" href="news.php?filter=event" role="tab" aria-controls="event" aria-selected="false">Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($filter == 'announcement') ? 'active' : ''; ?>" id="announcement-tab" href="news.php?filter=announcement" role="tab" aria-controls="announcement" aria-selected="false">Announcements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($filter == 'news') ? 'active' : ''; ?>" id="news-tab" href="news.php?filter=news" role="tab" aria-controls="news" aria-selected="false">News</a>
            </li>
        </ul>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <?php foreach ($news_items as $news) { ?>
          <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="p-4 bg-white">
              <span class="d-block text-secondary small text-uppercase"><?php echo date("M jS, Y", strtotime($news['date'])); ?></span>
              <h2 class="h5 text-black mb-3"><a href="single.php?id=<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a></h2>
              <p><?php echo $news['content']; ?></p>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>

      <div class="container mt-5" data-aos="fade-up">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <!-- Previous page link -->
                <li><a href="?page=<?php echo ($current_page > 1) ? ($current_page - 1) : 1; ?>&filter=<?php echo $filter; ?>">&lt;</a></li>

                <!-- Pagination links -->
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                  <li class="<?php echo ($i == $current_page) ? 'active' : ''; ?>"><a href="?page=<?php echo $i; ?>&filter=<?php echo $filter; ?>"><span><?php echo $i; ?></span></a></li>
                <?php } ?>

                <!-- Next page link -->
                <li><a href="?page=<?php echo ($current_page < $total_pages) ? ($current_page + 1) : $total_pages; ?>&filter=<?php echo $filter; ?>">&gt;</a></li>
              </ul>
            </div>
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

    <footer class="site-footer bg-light">
      <?php include_once("include/footer.php"); ?>
    </footer>

  </div>
  <?php include_once("include/script.php"); ?>
</body>
</html>
