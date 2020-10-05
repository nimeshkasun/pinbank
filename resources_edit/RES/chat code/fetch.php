<?php
//fetch.php
require_once '../db_class/dbConn.php';
$query = "SELECT accountBalance, aCurrency FROM tblAccount WHERE aUserEmail='nimesh.ekanayaka7@gmail.com'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
  echo '<p>'.$row["accountBalance"].'</p>';
 }
}
?>