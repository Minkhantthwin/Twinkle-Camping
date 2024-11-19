<?php
session_start();
include('connect.php');
include('AutoID_Functions.php');
include('Shopping_Cart_Functions.php');

if (isset($_POST['btnAdd']))
{

	$ID=$_POST['ProductID'];
	$txtBuyQuantity=$_POST['txtBuyQuantity'];

	AddProduct($ID,$txtBuyQuantity);
}

if(isset($_GET['ProductID']))
{
	$ID=$_GET['ProductID'];

  $query = "SELECT p.*,b.BrandName, c.CategoryName FROM product p, brand b, category c WHERE p.ProductID='$ID' AND 
   p.BrandID = b.BrandID AND p.CategoryID = c.CategoryID";
  $result = mysqli_query($connect, $query);
	$row=mysqli_fetch_array($result);

	$ProductID=$row['ProductID'];
  $ProductName=$row['ProductName'];
  $Image = $row['ProductPhoto1'];
  $Folder="../twinkle_admin/products/";
  $FileImage=$Folder . '_' . $Image;

	
}
else
{
	echo "<script>window.location='Shopping_Cart.php'</script>";

}

// if(!isset($_SESSION['CustomerID']))
// {
// 	echo "<script>window.location='customerlogin.php'</script>";
// }



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
      <div class="container section-title" data-aos="fade-up">
        <h2><?php echo $ProductName ?></h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row">
        <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
          
            <img src="<?php echo $FileImage ?>" class="img-thumbnail rounded-4 mb-4" alt="">
           
          </div>
          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="250">
          <div class="card">
             <div class="card-header text-center">
             <p><?php echo $row['Description'] ?></p>
             </div>
			                    <div class="card-body">
                          <div class="input-group mb-3">
                              <span class="input-group-text"><strong>Brand:</strong></span>
															<input type="text" class="form-control"  value="<?php echo $row['BrandName'] ?>" disabled readonly/>
															<span class="input-group-text"><i class="fa-brands fa-bandcamp"></i></span>
														</div>
                          <div class="input-group mb-3">
                              <span class="input-group-text"><strong>Category:</strong></span>
															<input type="text" class="form-control"  value="<?php echo $row['CategoryName'] ?>" disabled readonly/>
															<span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
														</div>
                          <div class="input-group mb-3">
                              <span class="input-group-text"><strong>Price:</strong></span>
															<input type="text" class="form-control"  value="<?php echo $row['Price'] ?> MMK" disabled readonly/>
															<span class="input-group-text"><i class="fa-regular fa-credit-card"></i></span>
														</div>
                          <div class="input-group mb-3">
                              <span class="input-group-text"><strong>Size:</strong></span>
															<input type="text" class="form-control"  value="<?php echo $row['Size'] ?>" disabled readonly/>
															<span class="input-group-text"><i class="fa-solid fa-maximize"></i></span>
														</div>	                           
	                        <form  method="post">
                            <input type="hidden" name="ProductID" value="<?php echo $row['ProductID'] ?>">

														<div class="input-group mb-3">
                              <span class="input-group-text"><strong>Order Amount:</strong></span>
															<input type="number" class="form-control" name="txtBuyQuantity" value="1" min="1" required/>
															<span class="input-group-text"><i class="fa-solid fa-basket-shopping"></i></span>
														</div>
                         
                    </div>
                    <div class="card-footer text-end">
                      <?php
                      if(isset($_SESSION['CustomerID'])){
                      ?>
                    <input type="submit" name="btnAdd" class="submit-btn" value="Add to Cart">
                    <?php 
                      }
                      else {
                        echo '<a href="customerlogin.php" class="submit-btn">Sign in to proceed</a>';
                      }
                    ?>
                    </div>

                    </form>
                </div>
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