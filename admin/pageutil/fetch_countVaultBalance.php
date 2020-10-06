<?php
//fetch.php
require_once '../../db_class/dbConn.php';
$result = $conn->query("SELECT ROUND(SUM(accountBalance), 2) AS sumbal, acurrency FROM tblaccount");
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$accountBalance = $row['sumBal'];
		$aCurrency = $row['aCurrency'];
	}
}
?>

<div class="card user-widget-card bg-c-blue">
	<div class="card-block">
		<i class="feather icon-home bg-simple-c-blue card1-icon"></i>
		<h4><?php echo $aCurrency; ?> <?php echo $accountBalance; ?></h4>
		<p>Vault Balance</p>
	</div>
</div>