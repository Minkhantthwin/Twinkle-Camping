<?php
function AddProduct($ID,$BuyQuantity)
{
	include('connect.php');

	$query="SELECT * FROM product WHERE ProductID='$ID' ";
	$ret=mysqli_query($connect,$query);
	$count=mysqli_num_rows($ret);
	$row=mysqli_fetch_array($ret);

	if ($count < 1)
	{
		echo "<p>No Item Found!</p>";
		exit();
	}

	if ($BuyQuantity < 1)
	{
		echo "<script>window.alert('Please enter correct quantity.')</script>";
		echo "<script>window.location='Shopping_Cart.php'</script>";
	}

	if(isset($_SESSION['Shopping_Cart_Functions']))
	{
		$index=IndexOf($ID);

		if($index == -1)
		{
			$size=count($_SESSION['Shopping_Cart_Functions']);

			$_SESSION['Shopping_Cart_Functions'][$size]['ProductID']=$ID;
			$_SESSION['Shopping_Cart_Functions'][$size]['BuyQuantity']=$BuyQuantity;

			$_SESSION['Shopping_Cart_Functions'][$size]['Price']=$row['Price'];
			$_SESSION['Shopping_Cart_Functions'][$size]['Image']=$row['ProductPhoto1'];
			$_SESSION['Shopping_Cart_Functions'][$size]['ProductName']=$row['ProductName'];
		}
		else
		{
			$_SESSION['Shopping_Cart_Functions'][$index]['BuyQuantity']+=$BuyQuantity;
		}
	}
	else
	{
		$_SESSION['Shopping_Cart_Functions']=array(); //Create Session Array

		$_SESSION['Shopping_Cart_Functions'][0]['ProductID']=$ID;
		$_SESSION['Shopping_Cart_Functions'][0]['BuyQuantity']=$BuyQuantity;

		$_SESSION['Shopping_Cart_Functions'][0]['Price']=$row['Price'];
		$_SESSION['Shopping_Cart_Functions'][0]['Image']=$row['ProductPhoto1'];
		$_SESSION['Shopping_Cart_Functions'][0]['ProductName']=$row['ProductName'];
	}
	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function RemoveProduct($ID)
{
	$index=IndexOf($ID);

	unset($_SESSION['Shopping_Cart_Functions'][$index]);

	$_SESSION['Shopping_Cart_Functions']=array_values($_SESSION['Shopping_Cart_Functions']);

	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['Shopping_Cart_Functions']);
	echo "<script>window.location='Shopping_Cart.php'</script>";

}


function CalculateTotalAmount()
{
	$TotalAmount=0;

	if (!isset($_SESSION['Shopping_Cart_Functions']))
	{
		$TotalAmount = 0;
		return $TotalAmount;
	}
	else
	{
		$size=count($_SESSION['Shopping_Cart_Functions']);

		for ($i=0; $i < $size; $i++)
		{
			$Price=$_SESSION['Shopping_Cart_Functions'][$i]['Price'];
			$BuyQuantity=$_SESSION['Shopping_Cart_Functions'][$i]['BuyQuantity'];

			$TotalAmount+=($Price * $BuyQuantity);
		}
		return $TotalAmount;
	}
}

function CalculateTotalQuantity()
{
	$TotalQuantiy=0;

	if (!isset($_SESSION['Shopping_Cart_Functions']))
	{
		$TotalQuantiy = 0;
		return $TotalQuantiy;
	}
	else
	{
		$size=count($_SESSION['Shopping_Cart_Functions']);

		for ($i=0; $i < $size; $i++)
		{

			$BuyQuantity=$_SESSION['Shopping_Cart_Functions'][$i]['BuyQuantity'];

			$TotalQuantiy+=$BuyQuantity;
		}
		return $TotalQuantiy;
	}
}

function IndexOf($ID)
{
	if (!isset($_SESSION['Shopping_Cart_Functions']))
	{
		return -1;
	}

	$size=count($_SESSION['Shopping_Cart_Functions']);

	if ($size < 1)
	{
		return -1;
	}

	for ($i=0; $i < $size; $i++)
	{
		if ($ID == $_SESSION['Shopping_Cart_Functions'][$i]['ProductID'])
		{
			return $i;
		}
	}
	return -1;
}

function UpdateQuantity($ID, $NewQuantity)
{
    if ($NewQuantity < 1) {
        RemoveProduct($ID);
    } else {
        $index = IndexOf($ID);
        if ($index != -1) {
            $_SESSION['Shopping_Cart_Functions'][$index]['BuyQuantity'] = $NewQuantity;
        }
    }
    echo "<script>window.location='Shopping_Cart.php'</script>";
}

?>
