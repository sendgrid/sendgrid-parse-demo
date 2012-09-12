<?php
$file = 'eventlog.txt';
$contents =  print_r($_POST, true);

file_put_contents($file, $contents, FILE_APPEND);

$event = $_POST["event"];
$email = $_POST["email"];

/*
switch($event){
	case "bounce":
		//add to list of invalid emails
		break;
	
	case "unsubscribe":
		//remove them from the list
		break;
}
*/

//reply with HTTP 200 Response so SendGrid doesn't retry the post
header("HTTP/1.1 200 OK");
?>