<?php
/*$arry = array (  
    array(
        "date1" => "2019-08-16", 
        "sentAmount" => 200
    ),array(
        "date1" => "2019-08-17", 
        "sentAmount" => 150
    ),array(
        "date1" => "2019-08-18", 
        "sentAmount" => 180
    ),array(
        "date1" => "2019-08-19", 
        "sentAmount" => 220
    ),array(
        "date1" => "2019-08-20", 
        "sentAmount" => 190
    ),array(
        "date2" => "2019-08-16", 
        "receivedAmount" => 150
    ),array(
        "date2" => "2019-08-17", 
        "receivedAmount" => 170
    ),array(
        "date2" => "2019-08-18", 
        "receivedAmount" => 180
    ),array(
        "date2" => "2019-08-19", 
        "receivedAmount" => 160
    ),array(
        "date2" => "2019-08-20", 
        "receivedAmount" => 175
    ), 
); 
print_r(json_encode($arry));

echo "<br><br>";*/
require_once '../../db_class/dbConn.php';
session_start();
$accountNumber = $_SESSION['accountNumber'];
$result = mysqli_query($conn, "SELECT tType, tDate, tAmount FROM tblTransactions WHERE tAccountNumber='$accountNumber' AND tAccountType='PRA' ");
   while($row = mysqli_fetch_array($result)) {
   	$dateGet = $row['tDate'];
   	$createDate = new DateTime($dateGet);
	$date[] = $createDate->format('Y-m-d');	
   }

$dateUnique =  array_unique($date);
//print_r($dateUnique);
//print_r(json_encode($dateUnique));

foreach ($dateUnique as $date) {
	//echo "$date <br>";
  	$result2 = mysqli_query($conn, "SELECT tType, tDate, tAmount FROM tblTransactions WHERE tAccountNumber='$accountNumber' AND tAccountType='PRA' AND tType='Send' AND tDate LIKE '{$date}%'");
   	$dayCost=0;
   	while($row = mysqli_fetch_array($result2)) {
   		$dayCost += $row['tAmount'];
   	}
	//echo $dayCost;
	$arrayChart[] = array("date1"=>$date,"sentAmount"=>$dayCost);
   		//$arrayChart[] = array("date2"=>$date2,"receivedAmount"=>$dayCost);
}

//echo "<br><br>";

foreach ($dateUnique as $date) {
	//echo "$date <br>";
  	$result3 = mysqli_query($conn, "SELECT tType, tDate, tAmount FROM tblTransactions WHERE tAccountNumber='$accountNumber' AND tAccountType='PRA' AND tType='Receive' AND tDate LIKE '{$date}%'");
   	$dayCost=0;
   	while($row = mysqli_fetch_array($result3)) {
   		$dayCost += $row['tAmount'];
   	}
	//echo $dayCost;
	$arrayChart[] = array("date2"=>$date,"receivedAmount"=>$dayCost);
   		//$arrayChart[] = array("date2"=>$date2,"receivedAmount"=>$dayCost);
}

print_r(json_encode($arrayChart));
?>