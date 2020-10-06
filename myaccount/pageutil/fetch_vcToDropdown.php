<?php
	$vAccountNumber = $_SESSION['accountNumber'];
	$result = $conn->query("SELECT vCardNumber, vCardName FROM tblvirtualcard WHERE vAccountNumber='$vAccountNumber'");
	if ($result->num_rows > 0) {
		$vCardNumber="";
		$vCardName="";
		$count = 0;
		while($row = $result->fetch_assoc()) {
			echo "<option value='{$row['vCardNumber']}'>{$row['vCardNumber']} - {$row['vCardName']}</option>";
		}
	}
?>