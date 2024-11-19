    <?php
    session_start();
    include('connect.php');
    include('AutoID_Functions.php');
    include('Shopping_Cart_Functions.php');



    if (!isset($_SESSION['CustomerID'])) {
      echo "<script>window.location='customerlogin.php'</script>";
    }

    if (isset($_GET['action'])) {
      $action = $_GET['action'];

      if ($action == 'remove') {
        $ID = $_GET['ProductID'];
        RemoveProduct($ID);
      } else if ($action == 'clearall') {
        ClearAll();
      }
    }

    if (isset($_GET['action']) && $_GET['action'] == 'update') {
      $ID = $_GET['ProductID'];
      $change = $_GET['change'];

      $index = IndexOf($ID);
      if ($index != -1) {
        $currentQuantity = $_SESSION['Shopping_Cart_Functions'][$index]['BuyQuantity'];

        if ($change == 'increase') {
          $newQuantity = $currentQuantity + 1;
        } else if ($change == 'decrease') {
          $newQuantity = $currentQuantity - 1;
        }

        UpdateQuantity($ID, $newQuantity);
      }
    }


    $CustomerID = $_SESSION['CustomerID'];
    $selectCustomer = "SELECT CustomerName FROM customer WHERE CustomerID = '$CustomerID'";
    $resultCustomer = mysqli_query($connect, $selectCustomer);
    $rowCustomer = mysqli_fetch_assoc($resultCustomer);
    $CustomerName = $rowCustomer['CustomerName'];

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

        <?php include('navbar.php'); ?>

      </header>

      <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section accent-background">

          <!-- <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-5 justify-content-between">
              <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h2><span>Welcome to </span><span class="accent">Twinkle</span></h2>
                <p>Our Organization is dedicated to supporting the amazing people who are passionate about camping outside, enjoying the natural beauties of our nation!</p>
                <div class="d-flex">
                  <a href="#about" class="btn-get-started">Get Started</a>
                  <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                </div>
              </div>
              <div class="col-lg-5 order-1 order-lg-2">
                <img src="assets/img/camping.png" class="img-fluid" alt="">
              </div>
            </div>
          </div> -->



        </section><!-- /Hero Section -->

        <section id="services" class="services section">

          <div class="container">
            <div class="row">
              <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5">Your Cart</h1>
              </div>

              <?php
              if (!isset($_SESSION['Shopping_Cart_Functions'])) {
                echo "<p>Your Cart is Empty.</p>";
                echo "<a href='index.php' class='btn btn-success'>Back to Home</a>";
              } else {
              ?>

                <div class="table-responsive wow fadeInUp" data-wow-delay="0.1s">
                  <table class="table table-bordered table-striped mt-3">
                    <tr>
                      <th>Product-ID</th>
                      <th>Product-Name</th>
                      <th>Price</th>
                      <th>Purchase quantity</th>
                      <th>Sub-Total</th>
                      <th>Action</th>
                    </tr>
                    <?php
                    $size = count($_SESSION['Shopping_Cart_Functions']);

                    for ($i = 0; $i < $size; $i++) {
                      $ID = $_SESSION['Shopping_Cart_Functions'][$i]['ProductID'];

                      echo "<tr>";
                      echo "<td>" . $_SESSION['Shopping_Cart_Functions'][$i]['ProductID'] . "</td>";
                      echo "<td>" . $_SESSION['Shopping_Cart_Functions'][$i]['ProductName'] . "</td>";
                      echo "<td>" . $_SESSION['Shopping_Cart_Functions'][$i]['Price'] . " MMK</td>";
                      echo "<td>
                                  <form action='Shopping_Cart.php' method='GET'>
                                    <input type='hidden' name='ProductID' value='" . $ID . "'>
                                    <input type='hidden' name='action' value='update'>
                                    <button type='submit' name='change' value='decrease' class='btn btn-sm btn-outline-secondary'>-</button>
                                    <input type='text' value='" . $_SESSION['Shopping_Cart_Functions'][$i]['BuyQuantity'] . "' size='2' readonly>
                                    <button type='submit' name='change' value='increase' class='btn btn-sm btn-outline-secondary'>+</button>
                                  </form>
                                </td>";

                      echo "<td>" . ($_SESSION['Shopping_Cart_Functions'][$i]['Price'] * $_SESSION['Shopping_Cart_Functions'][$i]['BuyQuantity']) . " MMK</td>";
                      echo "<td><a href='Shopping_Cart.php?action=remove&ProductID=$ID' class='btn btn-danger btn-sm'>Remove</a></td>";
                      echo "</tr>";
                    }
                    ?>
                    <tr>
                      <td class="text-start">
                        <a href="products.php" class="btn btn-success me-2">Add More</a>
                      </td>
                      <td colspan="6" class="text-end">
                        <a href="checkout.php" class="btn btn-success me-2">Checkout</a>
                        <a href="index.php" class="btn btn-success me-2">Back</a>
                        <a href="Shopping_Cart.php?action=clearall" class="btn btn-danger">Clear All</a>
                      </td>
                    </tr>
                  </table>
                </div>
              <?php
              }
              ?>


            </div>

          </div>

        </section><!-- /Services Section -->



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