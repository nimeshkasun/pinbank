<?php
require_once '../../db_class/dbConn.php';
session_start();
$accountNumber = $_SESSION['accountNumber'];

if(isset($_POST['view'])){

if($_POST["view"] != '')
{
    $update_query = "UPDATE tbltransactions SET notStatus = 0 WHERE notStatus=1 AND tAccountNumber='$accountNumber' AND tType='Receive'";
    mysqli_query($conn, $update_query);
}
$query = "SELECT * FROM tbltransactions WHERE tAccountNumber='$accountNumber' AND tType='Receive' ORDER BY tDate DESC LIMIT 5";
$result = mysqli_query($conn, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
  $output .= '<li><label class="label label-danger">Notifications</label></li>';
 while($row = mysqli_fetch_array($result))
 {
   $output .= '
   <li>
   <strong>'.$row["tDate"].'</strong><br />
   <small><em>'.$row["tDescription"].'</em></small>
   </li>
   ';

 }
}
else{
     $output .= '
     <li><label class="label label-danger">Notifications</label></li>';
}

$status_query = "SELECT * FROM tbltransactions WHERE notStatus=1 AND tAccountNumber='$accountNumber' AND tType='Receive'";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);

echo json_encode($data);

}

?>