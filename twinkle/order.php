<?php 
// Query to get total productssold
$query_total_products= "SELECT SUM(Quantity) AS total_products_sold FROM orderdetails";
$result_total_products= mysqli_query($connect, $query_total_products);
$row_total_products= mysqli_fetch_assoc($result_total_products);
$total_products_sold = $row_total_products['total_products_sold'];

// Query to get total earnings
$query_total_earnings = "SELECT SUM(GrandTotal) AS total_earnings FROM orders";
$result_total_earnings = mysqli_query($connect, $query_total_earnings);
$row_total_earnings = mysqli_fetch_assoc($result_total_earnings);
$total_earnings = $row_total_earnings['total_earnings'];

// Query for total earnings annually
$query_annual_earnings = "SELECT YEAR(OrderDate) AS order_year, SUM(GrandTotal) AS total_earnings_yearly
                          FROM orders
                          GROUP BY YEAR(OrderDate)";
$result_annual_earnings = mysqli_query($connect, $query_annual_earnings);

// Query for total earnings monthly (for the current year)
$current_year = date('Y'); // Get the current year
$query_monthly_earnings = "SELECT MONTH(OrderDate) AS order_month, SUM(GrandTotal) AS total_earnings_monthly
                           FROM orders
                           WHERE YEAR(OrderDate) = '$current_year'
                           GROUP BY MONTH(OrderDate)";
$result_monthly_earnings = mysqli_query($connect, $query_monthly_earnings);

// Initialize arrays to store the data
$annual_earnings = [];
while ($row_annual = mysqli_fetch_assoc($result_annual_earnings)) {
    $annual_earnings[$row_annual['order_year']] = $row_annual['total_earnings_yearly'];
}

$monthly_earnings = [];
while ($row_monthly = mysqli_fetch_assoc($result_monthly_earnings)) {
    $monthly_earnings[$row_monthly['order_month']] = $row_monthly['total_earnings_monthly'];
}

$query2 = "SELECT 
            SUM(od.Quantity) AS TotalDishesSold, 
            SUM(o.TotalAmount) AS TotalEarnings
           FROM orders o
           JOIN orderdetails od ON o.OrderID = od.OrderID
           WHERE MONTH(o.OrderDate) = MONTH(CURRENT_DATE())
           AND YEAR(o.OrderDate) = YEAR(CURRENT_DATE())";
           
$result2 = mysqli_query($connect, $query2);
$arr2 = mysqli_fetch_assoc($result2);
