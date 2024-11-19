<?php
session_start();
include('connect.php');
include('AutoID_Functions.php');
include('Shopping_Cart_Functions.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(!isset($_SESSION['CustomerID']))
{
	echo "<script>window.location='customerlogin.php'</script>";
}

require 'vendor/autoload.php';
$mail = new PHPMailer(true);

$CustomerID = $_SESSION['CustomerID'];
$selectCustomer = "SELECT * FROM customer WHERE CustomerID = '$CustomerID'";
$resultCustomer = mysqli_query($connect, $selectCustomer);
$rowCustomer = mysqli_fetch_assoc($resultCustomer);
$CustomerName = $rowCustomer['CustomerName'];
$CustomerEmail = $rowCustomer['Email'];
$Address= $rowCustomer['Address'];

if(isset($_POST['btnCheckout']))
{
	$txtOrderID=$_POST['txtOrderID'];
	$txtOrderDate=$_POST['date'];
	$rdoPaymentType=$_POST['payment'];
	$txtDirection=$_POST['txtDirection'];
  $optionalDir=$_POST['optionalDir'];
  $cbotown=$_POST['cbotown'];
	$txtTotalQuantity=$_POST['txtTotalQuantity'];
	$txtGrandTotal=$_POST['txtGrandTotal'];
	$txtVAT=$_POST['txtVat'];
	$txtTotalAmount=$_POST['txtTotalAmount'];
	$DeliveryStatus="Pending";
  $Status="Accepted";
  $txtComment=$_POST['txtComment'];
//Image Insert Starts
  $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
  $fileType = $_FILES['txtEvidence']['type'];
  
  if (in_array($fileType, $allowedTypes)) {
      $Folder = "img/evidence/";
      $FileName = $Folder . uniqid() . '_' . basename($_FILES['txtEvidence']['name']);
      if (move_uploaded_file($_FILES['txtEvidence']['tmp_name'], $FileName)) {
          echo "File uploaded successfully.";
      } else {
          echo "Failed to upload file.";
      }
  } else {
      echo "Invalid file type. Only JPG, PNG, and GIF are allowed.";
  }
  //Image Insert Ends

	$Insert1="INSERT INTO `orders`
			  (`OrderID`, `OrderDate`, `TotalAmount`, `TotalQuantity`, `GrandTotal`, `VAT`, `PaymentType`, `Direction`, `DeliveryStatus`, `CustomerID`, `TownshipID`, `OptionalDirection`, `Comments`, `Evidence`, `Status`)
			  VALUES
			  ('$txtOrderID','$txtOrderDate','$txtTotalAmount','$txtTotalQuantity','$txtGrandTotal','$txtVAT','$rdoPaymentType','$txtDirection','$DeliveryStatus','$CustomerID', '$cbotown', '$optionalDir', '$txtComment', '$FileName', '$Status')";
	$result=mysqli_query($connect,$Insert1);


	$size=count($_SESSION['Shopping_Cart_Functions']);
	for($i=0;$i<$size;$i++)
	{
        $ID = $_SESSION['Shopping_Cart_Functions'][ $i ]['ProductID'];
        $name = $_SESSION['Shopping_Cart_Functions'][ $i ]['ProductName'];
        $price = $_SESSION['Shopping_Cart_Functions'][ $i ]['Price'];
        $quantity= $_SESSION['Shopping_Cart_Functions'][$i]['BuyQuantity'];

    $Insert2="INSERT INTO `orderdetails`
          (`OrderID`, `ProductID`, `Price`, `Quantity`, `ProductName` )
          VALUES
          ('$txtOrderID','$ID','$price','$quantity', '$name')
          ";
		$result=mysqli_query($connect,$Insert2);


	}

	if($result)
	{

    try {
      // Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'minkhantthwin17@gmail.com';
      $mail->Password   = 'qpczrtvcfydzacct';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port       = 465;
  
      // Recipients
      $mail->setFrom($CustomerEmail, $CustomerName);
  
   $selectAdmin = "SELECT * FROM admin";
   $resultAdmin = mysqli_query($connect, $selectAdmin);
  
  if (mysqli_num_rows($resultAdmin) > 0){
          while ($rowAdmin = mysqli_fetch_assoc($resultAdmin)) {
      $AdminEmail = $rowAdmin['Email'];
      $AdminName = $rowAdmin['AdminName'];
  
      $mail->addAddress($AdminEmail, $AdminName);
    }
    
  }
  
      $mail->addReplyTo($CustomerEmail, $CustomerName);
      $mail->addCC($CustomerEmail);
      $mail->addBCC($CustomerEmail);
  
      // Content
      $mail->isHTML(true);
      $mail->Subject = $_POST["txtOrderID"];
      $mail->Body    = 'Additional Comment: ' . $_POST["txtComment"] . '.' . '<br>';
      if (isset($_SESSION['Shopping_Cart_Functions'])) {
        $mail->Body .= '<strong>Items Ordered:</strong><br>';
        foreach ($_SESSION['Shopping_Cart_Functions'] as $item) {
          $mail->Body .= htmlspecialchars($item['ProductName']) . ' - Quantity: ' . htmlspecialchars($item['BuyQuantity']) . '<br>';
        }
        $mail->Body .= $_POST["txtDirection"];
      }
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();

  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
	  
		unset($_SESSION['Shopping_Cart_Functions']);
		echo "<script>window.alert('Checkout Successfully Saved!')</script>";
		echo "<script>window.location='index.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Checkout. " . mysqli_error($connect) . "</p>";
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
        <h2>Checkout Form</h2>
      </div><!-- End Section Title -->
 <form action="checkout.php" method="post" enctype="multipart/form-data">
  <div class="container">
    <div class="row g-3">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-success">Your cart</span>
          <?php
			if (isset($_SESSION['Shopping_Cart_Functions'])) {
			$itemCount = count($_SESSION['Shopping_Cart_Functions']);
			if ($itemCount > 0) {
			echo "<span class='badge bg-success rounded-pill'>$itemCount</span>";
			}
				}
		    ?>
        </h4>
        <ul class="list-group mb-3">
            <?php
            $size = count($_SESSION['Shopping_Cart_Functions']);
            for ($i = 0; $i < $size; $i++) {
                $ID = $_SESSION['Shopping_Cart_Functions'][ $i ]['ProductID'];
                $name = $_SESSION['Shopping_Cart_Functions'][ $i ]['ProductName'];
                $price = $_SESSION['Shopping_Cart_Functions'][ $i ]['Price'];
                $quantity= $_SESSION['Shopping_Cart_Functions'][$i]['BuyQuantity'];
            ?>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?php echo $name .' x '. $quantity?></h6>
              <small class="text-body-secondary"><?php echo $price ?>MMK</small>
            </div>
            <span class="text-body-secondary">Sub-Total: <?php echo $price * $quantity ?>MMK</span>
          </li>
          <?php 
            }
          ?>
          <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
            <div class="text-success">
              <h6 class="my-0">VAT</h6>
              <small>1%</small>
            </div>
            <span class="text-success"><?php echo CalculateTotalAmount() * 0.01 ?>MMK</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total</span>
            <strong><?php echo CalculateTotalAmount()+(CalculateTotalAmount() * 0.01) ?>MMK</strong>
          </li>
        </ul>

        <!-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-dark">Redeem</button>
          </div>
        </form> -->
        <input type="hidden" name="txtTotalAmount" value="<?php echo CalculateTotalAmount()?>">
        <input type="hidden" name="txtGrandTotal" value="<?php echo CalculateTotalAmount()+(CalculateTotalAmount() * 0.01) ?>">
        <input type="hidden" name="txtVat" value="<?php echo CalculateTotalAmount() * 0.01 ?>">
        <input type="hidden" name="txtTotalQuantity" value="<?php echo CalculateTotalQuantity() ?>">
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Billing address</h4>
        
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="OrderID" class="form-label">Order No.</label>
              <input type="text" class="form-control" id="OrderID" name="txtOrderID" value="<?php echo AutoID('orders', 'OrderID', 'ORD-',6) ?>" readonly>
            </div>

            <div class="col-sm-6">
              <label for="date" class="form-label">Date</label>
              <input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d')?>" readonly>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" value="<?php echo $CustomerName?>" readonly> 
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" value="<?php echo $CustomerEmail ?>" readonly>
              
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" name="txtDirection" id="address" placeholder="1234 Main St" value="<?php echo $Address ?>" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Other Address<span class="text-body-secondary">(Optional)</span></label>
              <input type="text" class="form-control" name="optionalDir" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="col-md-3">
              <label for="township" class="form-label">Township</label>
              <select class="form-select" name="cbotown" id="township" required>
                <option value="">Choose...</option>
                <?php
				$query="SELECT * FROM township";
				$ret=mysqli_query($connect,$query);
				$count=mysqli_num_rows($ret);

				for ($i=0; $i <$count ; $i++) {
					$row=mysqli_fetch_array($ret);
					$type=$row['TownshipID'];
					$typename=$row['TownshipName'];
					echo "<option value='$type' data-typename='$typename'>$typename</option>";
				}
				?>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-9">
              <label for="comment" class="form-label">Additional Comment<span class="text-body-secondary"> (Optional)</span></label>
              <input type="text" class="form-control" id="comment" name="txtComment">
            </div>
          </div>

          <!-- <hr class="my-4"> -->

          <!-- <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address">
            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
          </div> -->

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div id="payment-options" class="my-3">
            <div class="form-check">
                <input id="cod" name="payment" type="radio" class="form-check-input" value="COD" checked="" required="" onclick="COD()">
                <label class="form-check-label" for="COD">Cash on Delivery</label>
            </div>
            <div class="form-check">
                <input id="card" name="payment" type="radio" class="form-check-input" value="card" required="" onclick="CARD()">
                <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
                <input id="kpay" name="payment" type="radio" class="form-check-input" value="kpay" required="" onclick="KPAY()">
                <label class="form-check-label" for="Kpay">KBZ Pay</label>
            </div>
            </div>
           <div id="cod_section" class="hidden">Cash On Delivery</div>

          <div id="card_section" class="hidden">
          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" id="cc-name" name="cc" placeholder="">
              <small class="text-body-secondary">Full name as displayed on card</small>

            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" name="ccv" placeholder="">

            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" name="ccs" placeholder="">
             
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" name="ccf" placeholder="">
             
            </div>
          </div>
          </div>
           
          <div id="kpay_section" class="mt-3 hidden">
            <div class="col-md-6">
            <div class="card text-center">
               <div class="card-body">
                <h5 class="card-title">Kpay Payment</h5>
                <img src="img/Kpay.png" width="200px" height="200px" alt="Kpay QR Code">
                <p class="card-text"><b>+95 9373327237837</b></p>
                </div>
                  </div>
                  <div class="card-footer">
                  <div class="row my-3">
            <div class="d-flex align-items-center">
            <label for="evidence" class="form-label me-2">Evidence: </label>
            <input type="file" class="form-control" name="txtEvidence" id="evidence">
            </div>
            </div>
                  </div>
            </div>
            </div>
           
          <hr class="my-4">

          <input class="submit-btn" type="submit" name="btnCheckout" value="Continue to checkout">

      </div>
    </div>

  </div>
</form>
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


<style>
  .hidden {
    display: none;
  }
  
</style>

  <script>
 document.getElementById('payment-options').addEventListener('change', function(event) {
  const sections = document.querySelectorAll('[id$="_section"]');
  sections.forEach(section => section.classList.add('hidden'));

  const selectedSection = document.getElementById(event.target.id + '_section');
  selectedSection.classList.remove('hidden');
});
</script>

</body>

</html>