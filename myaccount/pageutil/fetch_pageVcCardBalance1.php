<?php
//fetch.php
//session_start();
require_once '../db_class/dbConn.php';
$email = $_SESSION["emailsaved"];
$vAccountNumber = $_SESSION['accountNumber'];
$vCardBalance1="";
$vCardBalance2="";
$vCardBalance3="";
$vCardName1="";
$vCardName2="";
$vCardName3="";
$vCardNumber1="";
$vCardNumber2="";
$vCardNumber3="";
$vExpireDate1="";
$vExpireDate2="";
$vExpireDate3="";
$vCSV1="";
$vCSV2="";
$vCSV3="";
	$result = $conn->query("SELECT vCardNumber, vExpireDate, vCSV, vCardName, vCardBalance FROM tblVirtualCard WHERE vAccountNumber='$vAccountNumber'");
	if ($result->num_rows > 0) {
		
		$count = 0;
		while($row = $result->fetch_assoc()) {
			$count++;
			if($count==1){
				$vCardBalance1 = $row['vCardBalance'];
				$vCardName1 = $row['vCardName'];
				$vCardNumber1 =  $row['vCardNumber'];
				$vExpireDate1 =  $row['vExpireDate'];
				$vCSV1 =  $row['vCSV'];
			}
			if($count==2){
				$vCardBalance2 = $row['vCardBalance'];
				$vCardName2 = $row['vCardName'];
				$vCardNumber2 =  $row['vCardNumber'];
				$vExpireDate2 =  $row['vExpireDate'];
				$vCSV2 =  $row['vCSV'];
			}
			if($count==3){
				$vCardBalance3 = $row['vCardBalance'];
				$vCardName3 = $row['vCardName'];
				$vCardNumber3 =  $row['vCardNumber'];
				$vExpireDate3 =  $row['vExpireDate'];
				$vCSV3 =  $row['vCSV'];
			}
			
		}
	}

	$result = $conn->query("SELECT aCurrency FROM tblAccount WHERE aUserEmail='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$aCurrency = $row['aCurrency'];
		}
	}
?>

<?php if($vCardName1!=NULL){ ?>
<div class="card social-card text-white bg-c-pink">
    <div class="card-block">
    	<div class="row align-items-center">
			<div class="col">
		        <h6 class="m-b-0">Virtual Card: <?php echo $vCardName1; ?></h6>
		        <h4 class="m-t-10 m-b-10"><?php echo $aCurrency; ?> <?php echo $vCardBalance1; ?></h4>
		        <p class="m-b-0"><?php echo $vCardNumber1." ".$vExpireDate1." ".$vCSV1; ?></p>
		    </div>
		</div>
    </div>
    <a href="./dbClass.php?delVc=<?php echo $vCardNumber1; ?>" class="download-icon"><i class="ti-trash"></i></a>
</div>
<?php } ?>


