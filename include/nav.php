<div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
  <a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a>
</div>

<ul class="site-menu js-clone-nav d-none d-lg-block">
  <li class="active">
    <a href="index.php">Home</a>
  </li>
  <li>
    <a href="about.php">About</a>
  </li>
  <li class="has-children">
    <a href="apartments.php">Apartments</a>
    <ul class="dropdown arrow-top">
      <li><a href="apartments.php">All Apartments</a></li>
      <li class="has-children">
        <a href="#">Rooms</a>
        <ul class="dropdown">
          <?php
          $query_rooms = mysqli_query($koneksi, "SELECT DISTINCT rooms FROM properties ORDER BY rooms");
          while ($row = mysqli_fetch_assoc($query_rooms)) {
            $room_number = $row['rooms'];
            echo '<li><a href="apartments.php?rooms=' . $room_number . '">' . $room_number . ' Room' . ($room_number > 1 ? 's' : '') . '</a></li>';
          }
          ?>
        </ul>
      </li>
      <li class="has-children">
        <a href="#">Category</a>
        <ul class="dropdown">
          <li><a href="apartments.php?category=Modern%20House">Modern House</a></li>
          <li><a href="apartments.php?category=Urban%20Apartment">Urban Apartment</a></li>
          <li><a href="apartments.php?category=Luxury%20Apartment">Luxury Apartment</a></li>
          <li><a href="apartments.php?category=Modern%20Condo">Modern Condo</a></li>
          <li><a href="apartments.php?category=Riverside%20Apartment">Riverside Apartment</a></li>
          <li><a href="apartments.php?category=Luxury%20Villa">Luxury Villa</a></li>
          <li><a href="apartments.php?category=Beachfront%20Apartment">Beachfront Apartment</a></li>
          <li><a href="apartments.php?category=Penthouse%20Apartment">Penthouse Apartment</a></li>
        </ul>
      </li>
    </ul>
  </li>
  <li>
    <a href="news.php">News</a>
  </li>
  <li>
    <a href="contact.php">Contact</a>
  </li>
</ul>
