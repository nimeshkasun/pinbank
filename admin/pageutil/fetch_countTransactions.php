<?php
//fetch.php
session_start();
require_once '../../db_class/dbConn.php';


	$result = $conn->query("SELECT COUNT(tId) AS countTransactions FROM tbltransactions");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$countTransactions = $row['countTransactions'];
		}
	}
?>
			<div class="card user-widget-card bg-c-yellow">
                <div class="card-block">
                    <i class="feather icon-credit-card bg-simple-c-yellow card1-icon"></i>
                    <h4><h4><?php echo $countTransactions; ?></h4>
                    <p>Total Transactions</p>
                </div>
            </div>


