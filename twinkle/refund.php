<?php
session_start();
include('connect.php');

$OrderID = $_GET['OrderID'];

$select1 = "SELECT * FROM refund WHERE ID ='$OrderID'";
$ret1 = mysqli_query($connect, $select1);
$array = mysqli_fetch_array($ret1);

// Only set $replyValue if there is a refund record, otherwise leave it empty
$replyValue = isset($array['Reply']) ? $array['Reply'] : '';

$query = "SELECT o.*, GROUP_CONCAT(CONCAT(od.ProductName, ' (x', od.Quantity, ')') SEPARATOR ', ') AS Items, c.CustomerName, c.Phone
FROM orders o
JOIN orderdetails od ON o.OrderID = od.OrderID
JOIN customer c ON o.CustomerID = c.CustomerID
WHERE o.OrderID = '$OrderID' ";

$result = mysqli_query($connect, $query);
$arr = mysqli_fetch_array($result);

if (!isset($_SESSION['CustomerID'])) {
    echo "<script>window.location='customerlogin.php'</script>";
}

if (isset($_POST['btnRefund'])) {
    $ID = $_POST['txtOrderID'];
    $reason = $_POST['refund'];
    $reply = "...";

    $select = "SELECT * FROM refund WHERE ID ='$ID'";
    $ret = mysqli_query($connect, $select);
    $count = mysqli_num_rows($ret);

    if ($count > 0) {
        echo "<script>window.alert('You already refunded this order.')</script>";
        echo "<script>window.location='myOrder.php'</script>";
    } else {
        $query = "INSERT INTO refund(OrderID, Reason, Reply) values('$ID', '$reason', '$reply')";
        $result = mysqli_query($connect, $query);

        if ($result) {
            echo "<script>window.alert('Your refund request will be reviewed shortly.')</script>";
            echo "<script>window.location='refund.php?OrderID=$OrderID'</script>";
        } else {
            echo "<script>window.alert('Refund Error.')</script>";
        }
    }
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

  <style>
    label{
        font-weight: bold;
        margin-bottom: 10px;
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header fixed-top">
  <?php  include('navbar.php'); ?>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">

    </section><!-- /Hero Section -->

    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2><?php echo $OrderID ?></h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="250">
          <form class="user" method="post">
                              <input type="hidden" name="txtOrderID" value="<?php echo $OrderID ?>">
                              <div class="form-group row mb-3">
                              <div class="col-sm-3 mb-3 mb-sm-0">
                                      <label for="Items" class="ml-2">Customer-ID</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Customer-ID" name="txtbrand" value="C-<?php echo $arr['CustomerID'] .' (' . $arr['CustomerName'] . ')'; ?>" readonly>
                                  </div>
                                  <div class="col-sm-3 mb-3 mb-sm-0">
                                      <label for="Items" class="ml-2">Phone</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Customer-ID" name="txtbrand" value="<?php echo $arr['Phone']; ?>" readonly>
                                  </div>
                                  <div class="col-sm-6">
                                  <label for="Items" class="ml-2">Products</label>
                                  <input type="text" class="form-control form-control-user" id="Items"
                                  placeholder="Customer-ID" name="txtbrand" value="<?php echo $arr['Items']; ?>" readonly>
                                         <!-- <table class="form-control-user">
                                                <td><?php echo $arr['Items']; ?></td>
                                         </table> -->
                                  </div>
                              </div>
                              <div class="form-group row mb-3">
                              <div class="col-sm-3 mb-3 mb-sm-0">
                                      <label for="Items" class="ml-2">Total Amount</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Customer-ID" name="txtbrand" value="<?php echo $arr['TotalAmount']; ?> MMK" readonly>
                                  </div>
                                  <div class="col-sm-3">
                                  <label for="Items" class="ml-2">VAT</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Items" name="txtbrand" value="<?php echo $arr['VAT']; ?> MMK" readonly>
                                  </div>
                                  <div class="col-sm-3">
                                  <label for="Items" class="ml-2">Total Quantity</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Items" name="txtbrand" value="<?php echo $arr['TotalQuantity']; ?> (products)" readonly>
                                  </div>
                                  <div class="col-sm-3">
                                  <label for="Items" class="ml-2">GrandTotal</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Items" name="txtbrand" value="<?php echo $arr['GrandTotal']; ?> MMK" readonly>
                                  </div>
                              </div>
                              <div class="form-group row mb-3">
                              <div class="col-sm-8 mb-3 mb-sm-0">
                                      <label for="Items" class="ml-2">Direction</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Customer-ID" name="txtbrand" value="<?php echo $arr['Direction']; ?>" readonly>
                                  </div>
                                  <div class="col-sm-4">
                                  <label for="Items" class="ml-2">Payment-Type</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Items" name="txtbrand" value="<?php echo $arr['PaymentType']; ?>" readonly>
                                  </div>
                                
                              </div>
                              <div class="form-group row mb-3">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                      <label for="Items" class="ml-2">Optional-Direction</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Customer-ID" name="txtbrand" value="<?php echo $arr['OptionalDirection']; ?>" readonly>
                                  </div>
                                  <div class="col-sm-6">
                                  <label for="Items" class="ml-2">Additional Comment</label>
                                      <input type="text" class="form-control form-control-user" id="Items"
                                          placeholder="Items" name="txtbrand" value="<?php echo $arr['Comments']; ?>" readonly>
                                  </div>
                                
                              </div>    
                              <div class="form-group row mb-3">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <label for="refund" class="ml-2">Reason to Refund</label>
                                     <textarea name="refund" class="form-control form-control-user" id=""></textarea>
                              </div> 
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <label for="reply" class="ml-2">Replied Reason</label>
                                  <textarea name="reply" class="form-control form-control-user" id="" disabled><?php echo $replyValue; ?></textarea>
                              </div>                       
                              </div>
                              <div class="form-group row">
                                <div class="col-12 text-end">
                                    <input type="submit" name="btnRefund" class="submit-btn" value="Refund Order">

                                </div>
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

</body>

</html>