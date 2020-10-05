<?php
require 'sms/autoload.php';
$MessageBird = new \MessageBird\Client('liLLkRCJBTxY7tPPAPgXBJ6dZ');
$Message = new \MessageBird\Objects\Message();
$Message->originator = "PinBank";
$Message->recipients = array(+94718810575);
$Message->body = 'Pin Online Bank System Check: 1';

$MessageBird->messages->create($Message);

?>