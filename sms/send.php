<?php
		session_start();
		$phonesaved = $_SESSION["phonesaved"];
		//$phonesaved = '0718810575';
		include("newsletterslk.class.php");
        $mysms=new Newsletterslk;
        
        $mysms->setUser('5iAhRRFK5fRARQ6xDOofTkGCDtLxWU0W','B3xD1604488868');// Initializing User Api Key and Api Token
        $mysms->setSenderID('DEMO_SMS');// Initializing Sender ID Default Web SMS
        $mysms->msgType='sms';// Initializing Message Type
		$mysms->SendMessage($phonesaved,$smsMessage);
?>