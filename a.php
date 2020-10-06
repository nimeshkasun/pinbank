<?php
session_start();
$_SESSION['emailMe'] = "abc";
header('location: myaccount.php');
?>