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
	
	$userEmail=$_POST['userEmail'];
	$userPassword=$_POST['userPassword'];
	
	$query = "SELECT * FROM consumer WHERE Email='$userEmail'";

	$result=$mysqli->query("$query");
	$row=$result->fetch_assoc();
	if(password_verify("$userPassword",$row["Password"])){
		echo $_SESSION['loggedin'];
		$_SESSION['loggedin']="YES";
		$name=$row['Name'];
		$_SESSION['name']="$name";
		$url = "Location: welcome.php";
		header("$url");
		exit;
	}
	else{
		echo "Invalid";
		$_SESSION['loggedin']="NO";
		$_SESSION['name']="";
		$url = "Location: index.php";
		header("$url");
		exit;
	}
	
?>
