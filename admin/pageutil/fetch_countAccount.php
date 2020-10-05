<?php
//fetch.php

require_once '../../db_class/dbConn.php';
	$result = $conn->query("SELECT COUNT(accountNumber) AS countAcc FROM tblaccount");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$countAcc = $row['countAcc'];
		}
	}

?>
			<div class="card user-widget-card bg-c-pink">
                <div class="card-block">
                    <i class="feather icon-credit-card bg-simple-c-pink card1-icon"></i>
                    <h4><h4><?php echo $countAcc; ?></h4>
                    <p>Registered Accounts</p>
                </div>
            </div>


