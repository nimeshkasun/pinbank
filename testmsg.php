<?php
/*require 'sms/autoload.php';
$MessageBird = new \MessageBird\Client('aCfQ8JGMWcE8CZGuYREiX6IGG');
$Message = new \MessageBird\Objects\Message();
$Message->originator = "PinBank";
$Message->recipients = array(+94718810575);
$Message->body = 'Pin Online Bank System Check: 1';

$MessageBird->messages->create($Message);*/

 		

		$smsMessage = "Test Message";
		require_once 'sms/send.php';
?>