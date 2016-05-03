<?php
	session_start();
	$user = 'book_inv_user';
	$password = 'user123';
	$db = 'book_inventory';
	$host = 'localhost';
	$port = 8889;

	$mysqli = new mysqli("$host","$user","$password","$db","$port");
	if($mysqli->connect_errno){
		echo "Connection to MySQL failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
	}
	
	$empEmail=$_POST['empEmail'];
	$empPassword=password_hash($_POST['empPassword'],PASSWORD_DEFAULT);
	$empDriversLicense=$_POST['empDriversLicense'];
	$empName=$_POST['empName'];
	$empAddress=$_POST['empAddress'];
	
	$query = "INSERT INTO employee (DriversLicense, Name, Address, Email, Password)
	VALUES($empDriversLicense,'$empName','$empAddress','$empEmail','$empPassword')";

	$result=$mysqli->query("$query");
	if($result){
		echo("Account Creation Successful");
		$_SESSION['loggedin']="YES";
		$_SESSION['emploggedin'] = "YES";
		$name=$row['Name'];
		$_SESSION['name']="$name";
		$_SESSION['EmpID'] = $row["EmpID"];
		$url = "Location: employeeportal.php";
		header("$url");
		exit;
	}
	else{
		echo("Account Creation Failed");
		$_SESSION['loggedin']="NO";
		$_SESSION['name']="";
		$url = "Location: employeeloginportal.php";
		header("$url");
		exit;
	}

?>
