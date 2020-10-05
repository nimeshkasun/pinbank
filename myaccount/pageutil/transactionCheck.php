<?php

$totalTransaction = 0;
$avgTransaction = 0;
$trasactionLimit = 0;

$result = $conn->query("SELECT transactionLimit FROM tbluserdetails WHERE email='$email'");
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$trasactionLimit = $row['transactionLimit'];
	}
	}else{
}

$result = $conn->query("SELECT * FROM tblTransactions WHERE tAccountNumber='$accountNumber' AND tType = 'Send' ORDER BY tId DESC LIMIT 30");
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$temp = $row['tAmount'] / 2;
		$totalTransaction = $totalTransaction + $temp;
	}

	$avgTransaction = ($totalTransaction/4) * 3;
	$_SESSION['avgTransaction'] = $avgTransaction;
	$_SESSION['trasactionLimit'] = $trasactionLimit;
}

?>