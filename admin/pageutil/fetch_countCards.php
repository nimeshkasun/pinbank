<?php
//fetch.php
require_once '../../db_class/dbConn.php';

	$result = $conn->query("SELECT COUNT(vCardName) AS countCard FROM tblVirtualCard");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$countCard = $row['countCard'];
		}
	}
?>
			<div class="card user-widget-card bg-c-green">
                <div class="card-block">
                    <i class="feather icon-credit-card bg-simple-c-green card1-icon"></i>
                    <h4><h4><?php echo $countCard; ?></h4>
                    <p>Active Virtual Cards</p>
                </div>
            </div>


