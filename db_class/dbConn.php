<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "pinDB";
	if(mysqli_connect($servername, $username, $password, $database))
	{
		$conn = mysqli_connect($servername, $username, $password, $database);
		if(isset($_GET['execute'])){
			echo $success."(1) Connect to DB"."<br><br>";
		}
	}
	else
	{
		if(isset($_GET['execute'])){
			echo $bug."(2) Connect to DB: " . mysqli_connect_errno()."<br><br>";
		}
	}
?>