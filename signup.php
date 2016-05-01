<?php
	session_start();
	$user = 'root';
	$password = 'root';
	$db = 'book_inventory';
	$host = 'localhost';
	$port = 8889;

	$mysqli = new mysqli("$host","$user","$password","$db","$port");
	if($mysqli->connect_errno){
		echo "Connection to MySQL failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
	}
	
	$userEmail=$_POST['userEmail'];
	$userPassword=password_hash($_POST['userPassword'],PASSWORD_DEFAULT);
	$userDriversLicense=$_POST['userDriversLicense'];
	$userName=$_POST['userName'];
	$userShippingAddress=$_POST['userShippingAddress'];
	$userBillingAddress=$_POST['userBillingAddress'];
	
	$query = "INSERT INTO Consumer (DriversLicense,Name,ShippingAddress,BillingAddress,Email,Password) 
				VALUES($userDriversLicense,'$userName','$userShippingAddress','$userBillingAddress','$userEmail','$userPassword')";

	$result=$mysqli->query("$query");
	if($result){
		echo("Account Creation Successful");
		echo $_SESSION['loggedin'];
		$_SESSION['loggedin']="YES";
		$_SESSION['name']="$userName";
		$url = "Location: welcome.php";
		header("$url");
		exit;
	}
	else{
		echo("Account Creation Failed");
		echo $_SESSION['loggedin'];
		$_SESSION['loggedin']="No";
		$_SESSION['name']="";
		$url = "Location: index.php";
		header("$url");
		exit;
	}
	
?>
