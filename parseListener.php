<?php
require_once "lib/swift_required.php";

$file = 'parselog.txt';
$contents =  print_r($_POST, true);

file_put_contents($file, $contents, FILE_APPEND);

$num_dice = (int)$_REQUEST["text"];

$img = array();
$img[] = '<img src="http://dev.brandonmwest.com/dice1.png" />';
$img[] = '<img src="http://dev.brandonmwest.com/dice2.png" />';
$img[] = '<img src="http://dev.brandonmwest.com/dice3.png" />';
$img[] = '<img src="http://dev.brandonmwest.com/dice4.png" />';
$img[] = '<img src="http://dev.brandonmwest.com/dice5.png" />';
$img[] = '<img src="http://dev.brandonmwest.com/dice6.png" />';

$text = "Rolled " . $num_dice . " dice.";
$html = "<h1>" . $text . "</h1>";

for($i=0; $i<$num_dice; $i++){
	//Generate a random number between 1 &amp; 6
	$count = rand(0,5);

	//Assign $dice with the image chosen in the array
	$image = $img[$count];
	
	$text = $text . "\n" . ($count+1);
	$html = $html . "<br/>" . $image . "&nbsp;" .  ($count+1);		
}



// Login credentials
// Set these to match your SendGrid.com account
$username = 'sendgrid_username';
$password = 'sendgrid_password';

// Setup Swift mailer parameters
$transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
$transport->setUsername($username);
$transport->setPassword($password);
$swift = Swift_Mailer::newInstance($transport);

// Create a message (subject)
$message = new Swift_Message($subject);

$sender = $_REQUEST["from"];
$sender = substr($sender, strpos($sender, '<')+1, -1);

// This is your From email address
$from = array('demo@sendgrid.com' => 'SendGrid Demo');

// attach the body of the email
$message->setFrom($from);
$message->setBody($html, 'text/html');
$message->setTo($sender);
$message->setSubject("Your dice have been rolled!"); 
$message->addPart($text, 'text/plain');

// send message 
if ($recipients = $swift->send($message, $failures)) {
	$contents = 'Message sent out to ' . $recipients . ' users';
}
else {
	$contents = "Something went wrong - " . $failures;
}	
	
file_put_contents($file, $contents, FILE_APPEND);

?>