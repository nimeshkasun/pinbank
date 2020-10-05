<?php
//fetch.php
//session_start();
require_once '../db_class/dbConn.php';
 $transacLimit = "";

$email = $_SESSION["emailsavedCust"];
	$result = $conn->query("SELECT transactionLimit FROM tblUserDetails WHERE email='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$transacLimit = $row['transactionLimit'];
		}
	}
?>