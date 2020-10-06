<?php
//fetch.php
session_start();
require_once '../../db_class/dbConn.php';
$email = $_SESSION["emailsaved"];
$vAccountNumber = $_SESSION['accountNumber'];
$vCardBalance1="";
$vCardBalance2="";
$vCardBalance3="";
$vCardName1="";
$vCardName2="";
$vCardName3="";
	$result = $conn->query("SELECT vCardName, vCardBalance FROM tblvirtualcard WHERE vAccountNumber='$vAccountNumber'");
	if ($result->num_rows > 0) {

		$count = 0;
		while($row = $result->fetch_assoc()) {
			$count++;
			if($count==1){
				$vCardBalance1 = $row['vCardBalance'];
				$vCardName1 = $row['vCardName'];
			}
			if($count==2){
				$vCardBalance2 = $row['vCardBalance'];
				$vCardName2 = $row['vCardName'];
			}
			if($count==3){
				$vCardBalance3 = $row['vCardBalance'];
				$vCardName3 = $row['vCardName'];
			}
			
		}
	}

	$result = $conn->query("SELECT aCurrency FROM tblaccount WHERE aUserEmail='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$aCurrency = $row['aCurrency'];
		}
	}
?>
		<?php if($vCardBalance2!=NULL){ ?>
			<div class="card user-widget-card bg-c-green">
                <div class="card-block">
                    <i class="feather icon-credit-card bg-simple-c-green card1-icon"></i>
                    <h4><h4><?php echo $aCurrency; ?> <?php echo $vCardBalance2; ?></h4>
                    <p>Virtual Card: <?php echo $vCardName2; ?></p>
                    <a href="./vc.php" class="more-info">More Info</a>
                </div>
            </div>
        <?php } ?>


