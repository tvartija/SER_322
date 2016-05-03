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
	$empPassword=$_POST['empPassword'];
	
	$query = "SELECT * FROM employee WHERE Email='$empEmail'";

	$result=$mysqli->query("$query");
	$row=$result->fetch_assoc();

	if(password_verify("$empPassword",$row["Password"])){
		//echo $_SESSION['loggedin'];
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
		echo "Invalid";
		$_SESSION['loggedin']="NO";
		$_SESSION['name']="";
		$url = "Location: employeeloginportal.php";
		header("$url");
		exit;
	}
	
?>
