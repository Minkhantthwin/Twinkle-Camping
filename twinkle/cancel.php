<?php
session_start();
include('connect.php');

$BookingID = $_GET['BookingID'];

$Delete = "DELETE FROM booking WHERE BookingID='$BookingID' ";
$result = mysqli_query($connect, $Delete);

if ($result) {

    $CustomerID = $_SESSION['CustomerID'];
    $updateCustomer = "UPDATE customer SET Booking_Count=Booking_Count-1 WHERE CustomerID = '$CustomerID' ";
    mysqli_query($connect, $updateCustomer);

    echo "<script>window.alert('Successfully Deleted!')</script>";
    echo "<script>window.location='myBooking.php'</script>";
} else {
    echo "<p>Something went wrong." . mysqli_error($connect) . "</p>";
}

