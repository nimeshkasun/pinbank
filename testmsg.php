<?php
/*require 'sms/autoload.php';
$MessageBird = new \MessageBird\Client('aCfQ8JGMWcE8CZGuYREiX6IGG');
$Message = new \MessageBird\Objects\Message();
$Message->originator = "PinBank";
$Message->recipients = array(+94718810575);
$Message->body = 'Pin Online Bank System Check: 1';

$MessageBird->messages->create($Message);*/

 		/*include("smsn/newsletterslk.class.php");
        $mysms=new Newsletterslk;
        
        $mysms->setUser('5iAhRRFK5fRARQ6xDOofTkGCDtLxWU0W','B3xD1604488868');// Initializing User Api Key and Api Token
        $mysms->setSenderID('DEMO_SMS');// Initializing Sender ID Default Web SMS
        $mysms->msgType='sms';// Initializing Message Type
		$mysms->SendMessage('0718810575','Pin Test');*/

		$smsMessage = "Test Message";
		require_once 'sms/send.php';
?>