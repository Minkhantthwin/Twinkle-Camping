<?php
session_start();
include('connect.php');
include('AutoID_Functions.php');

$CustomerID = $_SESSION['CustomerID'];

if (isset($_GET['PackageID'])) {
  $ID = $_GET['PackageID'];

  $query = "SELECT * FROM package
            WHERE PackageID = '$ID'";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);

  $PackageID = $row['PackageID'];
  $PackageName = $row['PackageName'];
  $Description = $row["Description"];
  $Duration = $row["Duration"];
  $Price = $row["Price"];
  $Car = $row["CarName"];
  $Quantity = $row["Quantity"];
  $Image = $row['PackagePhoto1'];
  $Folder = "../twinkle_admin/products/";
  $FileImage = $Folder . '_' . $Image;
} else {
  echo "<script>window.location='package.php'</script>";
}

if (isset($_POST['btnBook'])) {

  $BID = $_POST['BookingID'];
  $SDate = $_POST['startDate'];
  $EDate = $_POST['endDate'];
  $Comment = $_POST['comment'];
  $Name = $_POST['PackageName'];
  $Status = "Pending";
  $cardname=$_POST['cc'];
  $card=$_POST['payment'];
  $number=$_POST['ccn'];

  $select = "SELECT Booking_Count FROM customer WHERE CustomerID = '$CustomerID'";
  $resultCustomer = mysqli_query($connect, $select);
  $rowCustomer = mysqli_fetch_assoc($resultCustomer);
  $BookingCount = $rowCustomer['Booking_Count'];

  $limit = 2;

  if ($BookingCount > $limit) {

    echo "<script>window.alert('You have reached maximum number of booking.')</script>";
    echo "<script>window.location='package.php'</script>";
    exit();
  }

  if ($Quantity > 0) {
    $insert = "INSERT INTO booking(`BookingID`,`StartDate`, `EndDate`, `Comment`, `PackageName`, `CustomerID`, `Status`, `CardType`, `CardName`,`CardNumber`)
      VALUES
      ('$BID','$SDate', '$EDate', '$Comment', '$Name', '$CustomerID', '$Status', '$card', '$cardname', '$number')";

    $ret = mysqli_query($connect, $insert);

    if ($ret) {
      $updateQuantity = "UPDATE package set Quantity = Quantity - 1 WHERE PackageID = '$PackageID'";
      mysqli_query($connect, $updateQuantity);

      $updateCount = "UPDATE customer set Booking_Count = Booking_Count + 1 WHERE CustomerID = '$CustomerID'";
      mysqli_query($connect, $updateCount);
    } else {
      echo "Error: " . mysqli_error($connect);
    }
    echo "<script>window.location='package.php'</script>";
  } else {
    echo "<script>window.alert('These packages are already booked.')</script>";
  }
}

if (!isset($_SESSION['CustomerID'])) {
  echo "<script>window.location='customerlogin.php'</script>";
}



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
  <script src="https://kit.fontawesome.com/567cac583c.js" crossorigin="anonymous"></script>

</head>

<body class="index-page">

  <header id="header" class="header fixed-top">
    <?php include('navbar.php'); ?>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">

    </section><!-- /Hero Section -->

    <section id="services" class="services section">

      <!-- Section Title -->
      <!-- <div class="container section-title" data-aos="fade-up">
        <h2>Package-</h2>
      </div>End Section Title -->

      <div class="container">
        <form method="POST">
          <div class="row">
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">

              <div class="service-item text-center position-relative">

                <div class="mb-3">
                  <img src="<?php echo $FileImage ?>" class='img-thumbnail' alt=''>
                </div>
                <h3><?php echo $PackageName ?></h3>
                <p>Duration:<?php echo $Duration ?> Days</p>
                <p>Vehicle: <?php echo $Car ?></p>
                <p>Price: <?php echo $Price ?> MMK</p>
                <p>Quantity: <?php echo $Quantity ?> Packages</p>
                <p><?php echo $Description ?></p>
              </div>

            </div>
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="250">
              <div class="card">
                <div class="card-header text-center">

                  <h3>Booking Process For <?php echo AutoID('booking', 'BookingID', 'B-', 5) ?></h3>
                </div>
                <div class="card-body">
                  <input type="hidden" name="PackageName" value="<?php echo $PackageName ?>">
                  <input type="hidden" name="BookingID" value="<?php echo AutoID('booking', 'BookingID', 'B-', 5) ?>">
                  <div class="row mb-3">
                    <div class="col-sm-6">
                      <label for="Start-Date" class="form-label">Start-Date</label>
                      <input type="date" class="form-control" id="Start-Date" name="startDate" min="" required>
                    </div>
                    <div class="col-sm-6">
                      <label for="End-Date" class="form-label">End-Date</label>
                      <input type="date" class="form-control" id="End-Date" name="endDate" readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-12">
                      <label for="comment" class="form-label">Additional Comment</label>
                      <textarea name="comment" id="comment" class="form-control"></textarea>
                    </div>
                  </div>
                  <div id="credit-info-container" style="display: none;">
                  <hr>
                  <div class="row gy-3">
                  <h3 class="h4 mb-3 text-start">Credit Information</h3>
                  <div id="payment-options" class="my-1">
                                                <div class="form-check">
                                                <input id="cod" name="payment" type="radio" class="form-check-input" value="visa" checked="" required="" onclick="COD()">
                                                <label class="form-check-label" for="COD">Visa Card</label>
                                                </div>
                                                <div class="form-check">
                                                <input id="card" name="payment" type="radio" class="form-check-input" value="credit" required="" onclick="CARD()">
                                                <label class="form-check-label" for="credit">Credit</label>
                                                </div>
                                                <div class="form-check">
                                                <input id="kpay" name="payment" type="radio" class="form-check-input" value="mpu" required="" onclick="KPAY()">
                                                <label class="form-check-label" for="Kpay">MPU</label>
                                                </div>
                                            </div>
                    <div class="col-md-6">
                      <label for="cc-name" class="form-label">Name on card</label>
                      <input type="text" class="form-control" id="cc-name" name="cc" placeholder="" required>
                      <small class="text-body-secondary">Full name as displayed on card</small>

                    </div>

                    <div class="col-md-6">
                      <label for="cc-number" class="form-label">Credit card number</label>
                      <input type="text" class="form-control" id="cc-number" name="ccn" placeholder="" required>

                    </div>

                    <div class="col-md-3">
                      <label for="cc-expiration" class="form-label">Expiration</label>
                      <input type="text" class="form-control" id="cc-expiration" name="ccs" placeholder="" required>

                    </div>

                    <div class="col-md-3">
                      <label for="cc-cvv" class="form-label">CVV</label>
                      <input type="number" class="form-control" id="cc-cvv" name="cvv" min="3" required>

                    </div>
                  </div>
                  </div>

                </div>
                <div class="card-footer text-end">
                  <input class="submit-btn" type="submit" name="btnBook" value="Book">
                </div>
        </form>

      </div>

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

  <script>
  function calculateEndDate() {
    const startDateInput = document.getElementById('Start-Date').value;
    const duration = <?php echo $Duration; ?>;

    if (startDateInput) {
      const startDate = new Date(startDateInput);
      startDate.setDate(startDate.getDate() + duration);
      const endDate = startDate.toISOString().split('T')[0];

      const endDateInput = document.getElementById('End-Date');
      endDateInput.value = endDate;
      endDateInput.setAttribute('max', endDate);

      // Display credit information if both dates are set
      if (startDateInput && endDateInput.value) {
        document.getElementById('credit-info-container').style.display = 'block';
      }
    }
  }

  function setMinStartDate() {
    const today = new Date();
    const formattedToday = today.toISOString().split('T')[0];
    document.getElementById('Start-Date').setAttribute('min', formattedToday);
  }

  window.onload = setMinStartDate;
  document.getElementById('Start-Date').addEventListener('change', calculateEndDate);
</script>

</body>

</html>