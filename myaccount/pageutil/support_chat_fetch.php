<?php
require_once '../../db_class/dbClass.php'; 
session_start(); 
$q1 = "SELECT * FROM tblMessage WHERE email='".$_SESSION['chatEmail']."' ORDER BY mId DESC LIMIT 500";
$r1 = mysqli_query($conn, $q1);
while($row = mysqli_fetch_assoc($r1)){
	$message = $row['message'];
	$lName = $row['lName'];
	echo '<h6 style="color:yellow;">'.$lName.'</h6>';
	echo '<p style="color:white;">'.$message.'</p>';
	echo '<hr style="background-color:white;">';
}
?>