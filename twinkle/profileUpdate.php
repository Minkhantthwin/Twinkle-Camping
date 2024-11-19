<?php
session_start();
include('connect.php');
include('AutoID_Functions.php');

if(isset($_POST['btnUpdate']))
{
	$txtCustomerID=$_POST['txtCustomerID'];
	$txtname=$_POST['txtname'];
    $txtphone=$_POST['txtphone'];
    $txtemail=$_POST['txtemail'];
	$txtpassword=$_POST['txtpassword'];
	$txtnrc=$_POST['txtnrc'];
	$txtaddress=$_POST['txtaddress'];

	$Update="UPDATE customer
			 SET
			 CustomerName='$txtname',
       NRC='$txtnrc',
       Address='$txtaddress',
       Phone='$txtphone',
			 Email='$txtemail',
			 Password='$txtpassword'
			 WHERE
			 CustomerID='$txtCustomerID' ";
	$result=mysqli_query($connect,$Update);

	if($result)
	{
		echo "<script>window.alert('Successfully Updated!')</script>";
		echo "<script>window.location='profile.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Menu Update." . mysqli_error($connect) . "</p>";
	}
}

$CustomerID=$_GET['CustomerID'];

$query="SELECT * FROM customer WHERE CustomerID='$CustomerID' ";
$result=mysqli_query($connect,$query);
$arr=mysqli_fetch_array($result);



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
          <div class="container">
          <div class="card">
                 <div class="card-body">
                 <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                     <!-- <h5 class="section-title ff-secondary text-center text-primary fw-normal">Hi-Canteen Japanese Restaurant</h5> -->
                     <h2><i class="fa-solid fa-circle-user fa-xl text-dark"></i></h2>
                     <h1 class="mb-5">Account Update</h1>
                 </div>
                 <div class="row g-4">

                 <div class="col-md-12">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" placeholder="Your Name" name="txtname" value="<?php echo $arr['CustomerName']; ?>">
                                            <label for="name">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="email" placeholder="Your Email" name="txtphone" value="<?php echo $arr['Phone']; ?>">
                                            <label for="email">Phone No.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" placeholder="Subject" name="txtemail" value="<?php echo $arr['Email']; ?>">
                                            <label for="subject">Email</label>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" placeholder="Subject" name="txtpassword" value="<?php echo $arr['Password']; ?>">
                                            <label for="subject">Password</label>
                                        </div>
                                    </div>
                                     <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" placeholder="Subject" name="txtnrc" value="<?php echo $arr['NRC']; ?>">
                                            <label for="subject">NRC</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" placeholder="Subject" name="txtaddress" value="<?php echo $arr['Address']; ?>">
                                            <label for="subject">Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-end">
                                         <input  class="submit-btn w-100 py-3" type="submit" name="btnUpdate" value="Update"/>
                                    </div>

								 <input type="hidden" name="txtCustomerID" value="<?php echo $arr['CustomerID'] ?>">
                                </div>
                            </form>
                        </div>
                    </div>

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