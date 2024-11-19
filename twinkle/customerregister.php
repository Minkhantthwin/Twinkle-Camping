<?php

include('connect.php');

if (isset($_POST['btnsave']))
{
    $name=$_POST['txtname'];
    $username=$_POST['txtusername'];
    $phone=$_POST['txtphone'];
    $address=$_POST['txtaddress'];
    $nrc= $_POST['txtnrc'];
    $email=$_POST['txtemail'];
    $password=$_POST['txtpassword'];
    $bookingCount="0";

    $select = "SELECT * FROM customer WHERE Email='$email'";
    $ret=mysqli_query($connect,$select);
    $count=mysqli_num_rows($ret);

      if ($count>0)
      {
        echo "<script>window.alert(Account with this gmail already exists.)</script>";
        exit();
      }
      else
      {
        $query="INSERT INTO customer(CustomerName, NRC, Address, Phone, Email, Password, username, Booking_Count) values('$name','$nrc','$address','$phone','$email','$password','$username','$bookingCount')";
        $result=mysqli_query($connect, $query);

        if ($result) {
            echo "<script>window.alert(Your account has been successfully registered!)</script>";
            echo "<script>window.location='customerlogin.php'</script>";
        }
        else{
            echo "<p>Error in Entry</p>";
        }
      }
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Twinkle - Register</title>
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

<body class="starter-page-page">

  <header id="header" class="header fixed-top">

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

    

  </header>

  <main class="main">
 
   <!-- Login Section -->
    <section id="submit" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>
        <a href="#" class="logo">
          <img src="assets/img/twinklelogo.png" width="80" height="90">
        </a>
        Twinkle-Camping and Supplies
        </h2>
        <h4>Account Register</h4>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">

          <div class="submit col-lg-8 mx-auto">
            <form  method="POST" class="twinkle-form" data-aos="fade" >
              <div class="row gy-4">             

                <div class="col-md-6 ">
                  <input type="text" class="form-control" name="txtname" placeholder="Your Name" required/>
                </div>
                <div class="col-md-6 ">
                  <input type="text" class="form-control" name="txtusername" placeholder="Username" required/>
                </div>
               
                <div class="col-md-6 ">
                <input type="text" class="form-control" name="txtphone" placeholder="Phone-number" required/>
                </div>

                <div class="col-md-6 ">
                <input type="text" class="form-control" name="txtaddress" placeholder="Address" required/>
                </div>

                <div class="col-md-12 ">
                  <input type="text" class="form-control" name="txtnrc" placeholder="NRC" required="">
                </div>
                
                <div class="col-md-12 ">
                  <input type="email" class="form-control" name="txtemail" placeholder="Email" required="">
                </div>

                <div class="col-md-12 ">
                  <input type="password" class="form-control" name="txtpassword" placeholder="Password" required="">
                </div>

                <div class="col-md-12 text-center">
                  
                  <input class="submit-btn" type="submit" name="btnsave" value="Register"/>
                </div>
                <div class="text-center">
                    <p>Already a member? <a href="customerlogin.php">Login Here</a></p>
                  </div>
              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->


   
  </main>

  <footer id="footer" class="footer accent-background">

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
  <script src="assets/js/auth.js"></script>

</body>

</html>