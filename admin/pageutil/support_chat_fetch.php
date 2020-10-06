<?php
require_once '../../db_class/dbClass.php'; 
session_start(); 
//$q1 = "SELECT * FROM tblMessage WHERE email='".$_SESSION['chatEmail']."' ORDER BY mId DESC LIMIT 500";
//$q1 = "SELECT * FROM tblMessage  ORDER BY mId  DESC ";
$q1 = "SELECT * FROM tblmessage WHERE mId IN ( SELECT MAX(mId) FROM tblmessage GROUP BY email );";
$r1 = mysqli_query($conn, $q1);
//$lName = "";
while($row = mysqli_fetch_assoc($r1)){
	$email = $row['email'];
	$lName = $row['lName'];

		

	if($lName != 'Admin' && $lName != 'Staff' && $lName != 'Support')
	{
		$result = $conn->query("SELECT accountNumber FROM tblaccount WHERE aUserEmail='$email'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$accountNumber = $row['accountNumber'];
			}
		}else{
		}
		echo '<h5 style="color:yellow;">New Message!</h5><br>';
		echo '<h6 style="color:white;"><a href="./dbClass.php?searchAccount='.$accountNumber.'"> Reply </a> || '.$lName.' ___ '.$email.' ___ '.$accountNumber.'</h6>';
		echo '<hr style="background-color:white;">';
	}
	
}

?>
