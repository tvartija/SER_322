<?php
	session_start();
	$_SESSION['loggedin']='NO';
	$_SESSION['emploggedin']='NO';
	$_SESSION['name']='';
	$url = "Location: index.php";
	header("$url");
	exit;
?>