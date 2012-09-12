<?php
require_once "lib/swift_required.php";

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
 
// attach the body of the email
$message->setFrom(array('demo@sendgrid.com' => 'SendGrid Demo'));
$message->setBody($_REQUEST["body"], 'text/html');
$message->setTo($_REQUEST["email"]);
$message->setSubject($_REQUEST["subject"]); 

// send message 
if ($recipients = $swift->send($message, $failures)) {
  echo 'Message sent out to '.$recipients.' users';
}
else {
  echo "Something went wrong - ";
  print_r($failures);
}
?>