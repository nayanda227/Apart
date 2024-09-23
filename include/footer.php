<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="mb-5">
          <?php
          $query = mysqli_query($koneksi, "SELECT * FROM contents WHERE `contents`.`id` = 3");
          $contents = mysqli_fetch_array($query);
          ?>
          <h3 class="footer-heading mb-4">About Apart</h3>
          <p><?php echo $contents['body']; ?></p>
        </div>
        <div class="mb-5">
          <h3 class="footer-heading mb-4">Subscribe</h3>
          <form action="#" method="post" class="site-block-subscribe">
            <div class="input-group mb-3">
              <input type="text" class="form-control border-secondary bg-transparent" placeholder="Enter your email"
                aria-label="Enter Email" aria-describedby="button-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary rounded-top-right-0" type="button" id="button-addon2">Subscribe</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-4 mb-5 mb-lg-0">
        <div class="row mb-5">
          <div class="col-md-12">
            <h3 class="footer-heading mb-4">Navigations</h3>
          </div>
          <div class="col-md-6 col-lg-6">
            <ul class="list-unstyled">
              <li><a href="index.php">Home</a></li>
              <li><a href="apartments.php">Apartments</a></li>
              <li><a href="news.php">News</a></li>
              <li><a href="apartments.php">Featured Apartment</a></li>
            </ul>
          </div>
          <div class="col-md-6 col-lg-6">
            <ul class="list-unstyled">
              <li><a href="about.php">About Us</a></li>
              <li><a href="contact.php">Contact Us</a></li>
            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h3 class="footer-heading mb-4">Follow Us</h3>
            <div>
              <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-4 mb-5 mb-lg-0">
        <div class="mb-5">
          <h3 class="footer-heading mb-4">Watch Live Streaming</h3>
          <div class="block-16">
            <figure>
              <img src="images/img_1.jpg" alt="Image placeholder" class="img-fluid rounded">
              <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span class="icon-play"></span></a>
            </figure>
          </div>
        </div>
      </div>
    </div>
    <div class="row pt-5 mt-5 text-center">
      <div class="col-md-12">
        <p>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
      </div>
    </div>
  </div>
</footer>
