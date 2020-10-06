<?php
//fetch.php
//session_start();
require_once '../db_class/dbConn.php';
 $accType = "";

$email = $_SESSION["emailsaved"];
	$result = $conn->query("SELECT userType FROM tbluserdetails WHERE email='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$accType = $row['userType'];
		}
	}
?>