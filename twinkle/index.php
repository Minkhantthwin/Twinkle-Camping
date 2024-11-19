<?php
session_start();
include('connect.php');
include('order.php');

$reviewQuery = "SELECT * FROM reviews ORDER BY RAND() LIMIT 3";
$reviewResult = mysqli_query($connect, $reviewQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Twinkle - Camping With you!</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/forest.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/back.css" rel="stylesheet">
  

  
</head>

<body class="index-page">

  <header id="header" class="header fixed-top">
    <?php  include('navbar.php'); ?>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5 justify-content-between">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2><span>Welcome to </span><span class="accent">Twinkle</span></h2>
            <p>Our Organization is dedicated to supporting the amazing people who are passionate about camping outside, enjoying the natural beauties of our nation!</p>
            <div class="d-flex">
              <a href="#product" class="btn-get-started">Get Started</a>
              <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2">
            <img src="assets/img/camping.png" class="img-fluid" alt="">
          </div>
        </div>
      </div>

      <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
        <div class="container position-relative">
          <div class="row gy-4 mt-5">

            <div class="col-xl-3 col-md-6">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-fire"></i></div>
                <h4 class="title"><a href="#products" class="stretched-link">Camping Necessities</a></h4>
              </div>
            </div><!--End Icon Box -->

            <div class="col-xl-3 col-md-6">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-backpack"></i></div>
                <h4 class="title"><a href="#brands" class="stretched-link">Brands</a></h4>
              </div>
            </div><!--End Icon Box -->

            <div class="col-xl-3 col-md-6">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-backpack3-fill"></i></div>
                <h4 class="title"><a href="#reviews" class="stretched-link">Reviews</a></h4>
              </div>
            </div><!--End Icon Box -->

            <div class="col-xl-3 col-md-6">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-question-circle"></i></div>
                <h4 class="title"><a href="#FAQs" class="stretched-link">FAQs</a></h4>
              </div>
            </div><!--End Icon Box -->

          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

   

    <!-- Clients Section -->
    <section id="brands" class="clients section">

      <div class="container">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center">

          <div class="col-lg-5">
            <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-lg-7">

            <div class="row gy-4">

              <div class="col-lg-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-emoji-smile flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_products_sold ? $total_products_sold : '0'; ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Products</strong> <span>Sold All Time!!</span></p>
                  </div>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-journal-richtext flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $arr2['TotalDishesSold']; ?> " data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Products</strong> <span>sold just in this month.</span></p>
                  </div>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-headset flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Hours Of Support</strong> <span>from around the world.</span></p>
                  </div>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-people flex-shrink-0"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Employees</strong> <span>at your service.</span></p>
                  </div>
                </div>
              </div><!-- End Stats Item -->

            </div>

          </div>

        </div>

      </div>

    </section><!-- /Stats Section -->

  
    

    <!-- Product Section -->
    <section id="products" class="portfolio section">
   
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Products</h2>
        <p>Check Out these products!!!</p>
      </div><!-- End Section Title -->


      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
         <?php 
         	  $query = "SELECT p.*,b.BrandName FROM product p LEFT JOIN 
                                brand b ON p.BrandID = b.BrandID
                                ORDER BY RAND()
                                LIMIT 3";
            $result2 = mysqli_query($connect, $query);
            $size = mysqli_num_rows($result2);
            if ($size < 1) {
							echo "<p>No Record Found!</p>";
							} else {
         ?>
          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-1">Backpacks</li>
            <li data-filter=".filter-2">Sleeping Beds</li>
            <!-- <li data-filter=".filter-branding">Branding</li>
            <li data-filter=".filter-books">Books</li> -->

          </ul><!-- End Portfolio Filters -->
        
          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
         <?php 
            for ($i = 0; $i < $size; $i++) {
              $arr = mysqli_fetch_array($result2);
              $ID=$arr["ProductID"];
              $ProductName = $arr["ProductName"];
              $Description= $arr["Description"];
              $BrandName= $arr["BrandName"];
              $Image = $arr['ProductPhoto1'];
              $Folder="../twinkle_admin/products/";
              $FileImage=$Folder . '_' . $Image;

          echo '<div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-' .  $arr['CategoryID'] . '">';
          echo   ' <div class="portfolio-content h-100">';
          echo "<a href='$FileImage' data-gallery='portfolio-gallery-app' class='glightbox'><img src='$FileImage' class='img-fluid' style='height:400px; object-fit: cover;' alt=''></a>";
          echo      '<div class="portfolio-info">';
              echo   " <h4><a href='product-detail.php?ProductID=$ID' title='More Details'>$ProductName</a></h4>";
              echo "<p class='mb-2'><b>Brand: $BrandName</b></p>";
                  echo "<p>$Description</p>";
                
               echo '</div>';
            echo  '</div>';
           echo' </div>'; 
             }
            } 
            ?>
           

          </div><!-- End Portfolio Container -->
      
        </div>

      </div> 
        
    </section><!-- /Portfolio Section -->

    <section id="reviews" class="section">
   <div class="container section-title" data-aos="fade-up">
  <h2>Reviews By Consumers</h2>
  <p></p>
</div><!-- End Section Title -->
      <div class="container">
        <div class="row">      
          <?php while($reviewRow = mysqli_fetch_assoc($reviewResult)): ?>
          <div class="col-md-4">
            <div class="card h-100" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <h5 class="card-title"><?php echo $reviewRow['CustomerName']; ?></h5>
                <p class="card-text"><?php echo $reviewRow['Review']; ?></p>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
    </section><!-- /Reviews Section -->

       <!-- Faq Section -->
       <section id="FAQs" class="faq section">

<div class="container">

  <div class="row gy-4">

    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
      <div class="content px-xl-5">
        <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
       
      </div>
    </div>

    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

      <div class="faq-container">
        <div class="faq-item faq-active">
          <h3><span class="num">1.</span> <span>What is Twinkle Camping?</span></h3>
          <div class="faq-content">
            <p>Twinkle Camping is a one-stop shop for all your camping needs, offering a wide range of products and curated camping packages.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3><span class="num">2.</span> <span>What is included in a typical camping package?</span></h3>
          <div class="faq-content">
            <p> A typical camping package includes items such as tents, sleeping bags, cooking equipment, and other essentials.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3><span class="num">3.</span> <span>Do you offer rental services for camping gear?</span></h3>
          <div class="faq-content">
            <p>Currently, we do not offer rental services. However, we may introduce this option in the future.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3><span class="num">4.</span> <span> What brands do you carry?</span></h3>
          <div class="faq-content">
            <p>We offer free shipping on orders over [amount]. Shipping times may vary depending on your location.</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
          <h3><span class="num">5.</span> <span>What is your shipping policy?</span></h3>
          <div class="faq-content">
            <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
          </div>
          <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

      </div>

    </div>
  </div>

</div>

</section><!-- /Faq Section -->
   
  </main>

  <footer id="footer" class="footer accent-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Twinkle</span>
          </a>
          <p>Our Organization is dedicated to supporting the amazing people who are passionate about camping outside, enjoying the natural beauties of our nation!</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Camping Support</a></li>
            <li><a href="#">Supplies Rental</a></li>
            <li><a href="#">Product Sales</a></li>
            <li><a href="#">Booking</a></li>
            
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Office-13(B) Kan Yeik Tha Road</p>
          <p>Yangon, Wyndham Grand</p>
          <p>Myanmar</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+959444480796</span></p>
          <p><strong>Email:</strong> <span>twinkle@gmail.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">Twinkle</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://www.facebook.com/profile.php?id=100018049445963">Kim Su Pyae</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>