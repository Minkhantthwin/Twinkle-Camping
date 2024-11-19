<?php
include('connect.php');

if(isset($_SESSION['CustomerID']))
{
  $CustomerID = $_SESSION['CustomerID'];
  $selectCustomer = "SELECT * FROM customer WHERE CustomerID = '$CustomerID'";
  $resultCustomer = mysqli_query($connect, $selectCustomer);
  $rowCustomer = mysqli_fetch_assoc($resultCustomer);
  $CustomerName = $rowCustomer['CustomerName'];
  $CustomerEmail = $rowCustomer['Email'];
  $Phone = $rowCustomer['Phone'];
  $Address = $rowCustomer['Address'];
}

?>
<script src="https://kit.fontawesome.com/567cac583c.js" crossorigin="anonymous"></script>

<div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:twinklecamping@example.com">twinklecamping@gmail.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+959444480796</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          
          <img src="assets/img/twinklelogo.png" width="80" height="90">
          <h2 class="sitename">Twinkle</h2>
          <span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
          <?php
                // Check if the user is logged in or not
                if (!isset($_SESSION['CustomerID'])) {
                    // If the user is not logged in, show the "Sign in" option
                    echo '<li><a href="index.php" class="active">Home<br></a></li>
                          <li><a href="about.php">About</a></li>
                          <li><a href="contact.php">Contact</a></li>';
                } else {
                    // If the user is logged in, show the user dropdown with profile and logout options
                    echo '<li><a href="index.php" class="active">Home<br></a></li>
                          <li><a href="about.php">About</a></li>
                          <li><a href="package.php">Packages</a></li>
                          <li><a href="products.php">Products</a></li>
                          <li><a href="review.php">Reviews</a></li>
                          <li><a href="contact.php">Contact</a></li>';
                }
                ?>

            <li><a href="Shopping_Cart.php">
            <span class="position-relative">
            <i class="fa-solid fa-cart-shopping"></i>
												<?php
												if (isset($_SESSION['Shopping_Cart_Functions'])) {
													$itemCount = count($_SESSION['Shopping_Cart_Functions']);
													if ($itemCount > 0) {
														echo "<span class='badge bg-danger rounded-circle'>$itemCount</span>";
													}
												}
												?>
											</span>
            </a></li>
            
            <?php
                // Check if the user is logged in or not
                if (!isset($_SESSION['CustomerID'])) {
                    // If the user is not logged in, show the "Sign in" option
                    echo '<li><a href="customerlogin.php">Sign In</a></li>';
                } else {
                    // If the user is logged in, show the user dropdown with profile and logout options
                    echo '
                    <li class="dropdown"><a href="#"><span><img src="assets/img/user.png" width="30" height="30"></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                      <ul>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="myOrder.php">My Orders</a></li>
                        <li><a href="myBooking.php">My Bookings</a></li>
                        <li><a href="customerlogout.php">Logout</a></li>
                      </ul>
                    </li>';
                }
                ?>
          </ul>

          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

        </nav>

      </div>

    </div>
