<?php
//fetch.php
//session_start();
require_once '../db_class/dbConn.php';
 $accStatus = "";

$email = $_SESSION["emailsavedCust"];
	$result = $conn->query("SELECT userStatus FROM tbluserdetails WHERE email='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$accStatus = $row['userStatus'];
		}
	}
?>