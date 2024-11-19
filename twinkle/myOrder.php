<?php
session_start();
include('connect.php');
include('AutoID_Functions.php');

$CustomerID = $_SESSION['CustomerID'];

if(!isset($_SESSION['CustomerID']))
{
	echo "<script>window.location='customerlogin.php'</script>";
}

$limit = 7; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get current page number
$offset = ($page - 1) * $limit; // Calculate offset

// Get total number of orders for pagination
$totalQuery = "
    SELECT COUNT(DISTINCT o.OrderID) as totalOrders
    FROM orders o
    JOIN orderdetails od ON o.OrderID = od.OrderID
    JOIN customer c ON o.CustomerID = c.CustomerID
    WHERE o.CustomerID = '$CustomerID'
   
";
$totalResult = mysqli_query($connect, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalOrders = $totalRow['totalOrders'];

// Calculate total pages
$totalPages = ceil($totalOrders / $limit);



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
  <?php  include('navbar.php'); ?>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">

    

      

    </section><!-- /Hero Section -->

    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="section-title" data-aos="fade-up">
        <h2>Order-List</h2>
      </div><!-- End Section Title -->

      <div class="container">
        

                            <?php
                            
                            $query = "  SELECT o.*, GROUP_CONCAT(CONCAT(od.ProductName, ' (x', od.Quantity, ')') SEPARATOR ', ') AS Items
                                        FROM orders o
                                        JOIN orderdetails od ON o.OrderID = od.OrderID
                                        JOIN customer c ON o.CustomerID = c.CustomerID
                                        WHERE o.CustomerID = '$CustomerID'
                                        GROUP BY o.OrderID
                                        LIMIT $limit OFFSET $offset ";
							$result = mysqli_query($connect, $query);
							$size = mysqli_num_rows($result);

							if ($size < 1) {
							echo "<p>No Record Found!</p>";
							} else {
							?>                          
                <div class="card mb-4">
             
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>OrderID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Delivery Status</th>
                        <th>Products</th>
                        <th>Detail</th>
                    </tr>
                </thead>
              
            <tbody>
            <tr>
            <?php
                                while ($arr = mysqli_fetch_assoc($result)) {
                                $OrderID = $arr['OrderID'];
                                $CustomerID = $arr['CustomerID'];
                                echo "<tr>";
                                echo "<td>" . $OrderID . "</td>";
                                echo "<td>" . $arr['OrderDate'] . "</td>";
                                echo "<td>" . $arr['Status'] . "</td>";
                                echo "<td>" . $arr['DeliveryStatus'] . "</td>";
                                echo "<td>" . $arr['Items'] . "</td>";
                                echo"<td>";

                                if($arr['Status'] == "Declined" || $arr['DeliveryStatus'] =="Pending"){

                                    echo "<a class='btn btn-success' href='refund.php?OrderID=$OrderID'>Refund</a>";

                                } else{
                                    echo "<input type='submit' class='btn btn-success' value='Refund' disabled />";
                                }
                              
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    }
                    ?>
            </div>
                <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <!-- Previous Page Link -->
                    <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($page > 1){ echo "?page=".($page - 1); } else { echo '#'; } ?>">Previous</a>
                    </li>

                    <!-- Pagination Number Links -->
                    <?php for($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php if($i == $page){ echo 'active'; } ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next Page Link -->
                    <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($page < $totalPages) { echo "?page=".($page + 1); } else { echo '#'; } ?>">Next</a>
                    </li>
                </ul>
            </nav>

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