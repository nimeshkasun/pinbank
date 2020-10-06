<?php
//fetch.php
//session_start();
require_once '../db_class/dbConn.php';
$accountBalance = "";
$aCurrency = "";

$email = $_SESSION["emailsavedCust"];
	$result = $conn->query("SELECT accountNumber, accountBalance, aCurrency FROM tblaccount WHERE aUserEmail='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$accountBalance = $row['accountBalance'];
			$aCurrency = $row['aCurrency'];
			/*$_SESSION['accountNumber'] = $row['accountNumber'];*/
		}
	}
?>
<div class="card text-center text-white bg-c-green">
    <div class="card-block">
        <h6 class="m-b-0">Primary Account</h6>
        <h4 class="m-t-10 m-b-10"><?php echo $aCurrency; ?> <?php echo $accountBalance; ?></h4>
        <p class="m-b-0"><?php echo $_SESSION['accountNumberCust']; ?></p>
    </div>
</div>
