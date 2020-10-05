<?php
//session_start();
require_once '../db_class/dbConn.php';
$accountNumber = $_SESSION["accountNumber"];
$result = $conn->query("SELECT tType, tDate, tDescription, tAccountType, tAmount, tBalance FROM tblTransactions WHERE tAccountNumber='$accountNumber' AND tAccountType='PRA' ORDER BY tDate DESC");
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr>
                <td>{$row['tType']}</td>
                <td>{$row['tDate']}</td>
                <td>{$row['tDescription']}</td>
                <td>{$row['tAccountType']}</td>
                <td>{$row['tAmount']}</td>
                <td>{$row['tBalance']}</td>
            </tr>";
	}
}
?>
