<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "pinDB";
	$username_online = "pinonlin_superadmin";
	$password_online = "superKDU2020";
	$database_online = "pinonlin_pindb";
	if(mysqli_connect($servername, $username, $password, $database))
	{
		$conn = mysqli_connect($servername, $username, $password, $database);
		if(isset($_GET['execute'])){
			echo $success."(1) Connect to DB"."<br><br>";
		}
	}
	else if(mysqli_connect($servername, $username_online, $password_online, $database_online))
	{
		$conn = mysqli_connect($servername, $username, $password, $database);
		if(isset($_GET['execute'])){
			echo $success."(2) Connect to DB"."<br><br>";
		}
	}
	else
	{
		if(isset($_GET['execute'])){
			echo $bug."(3) Connect to DB: " . mysqli_connect_errno()."<br><br>";
		}
	}
?>