<?php
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
	$userPassword=$_POST['userPassword'];
	
	$query = "SELECT * FROM consumer WHERE Email='$userEmail'";

	$result=$mysqli->query("$query");
	$row=$result->fetch_assoc();
	if(password_verify("$userPassword",$row["Password"])){
		echo "Successful login";
	}
	else{
		echo "Invalid";
	}
	
?>
