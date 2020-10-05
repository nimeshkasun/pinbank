<?php
//fetch.php
session_start();
require_once '../../db_class/dbConn.php';
$email = $_SESSION["emailsaved"];
	$result = $conn->query("SELECT accountNumber, accountBalance, aCurrency FROM tblAccount WHERE aUserEmail='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$accountBalance = $row['accountBalance'];
			$aCurrency = $row['aCurrency'];
			$_SESSION['accountNumber'] = $row['accountNumber'];
			$_SESSION['aCurrency'] = $row['aCurrency'];
		}
	}
?>

			<div class="card user-widget-card bg-c-blue">
                <div class="card-block">
                    <i class="feather icon-home bg-simple-c-blue card1-icon"></i>
                    <h4><?php echo $aCurrency; ?> <?php echo $accountBalance; ?></h4>
                    <p>Primary Account</p>
                    <a href="./pra.php" class="more-info">More Info</a>
                </div>
            </div>