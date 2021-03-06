<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
//require '../PHPMailerAutoload.php';


//Load dependencies from composer
//If this causes an error, run 'composer install'
require 'vendor/autoload.php';


$to_email = $userData['email'];  // for sending email to someone
//Create a new PHPMailer instance
$mail = new PHPMailerOAuth;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Set AuthType
$mail->AuthType = 'XOAUTH2';

//User Email to use for SMTP authentication - Use the same Email used in Google Developer Console
$mail->oauthUserEmail = "manpreetsandhu1208@gmail.com";

//Obtained From Google Developer Console
$mail->oauthClientId = "83719343065-kkmir0dq39n91a3fq8epsn02ac8nf2is.apps.googleusercontent.com";

//Obtained From Google Developer Console
$mail->oauthClientSecret = "WcGvEnrsrQ3-OyjlHMQmwLjG";

//Obtained By running get_oauth_token.php after setting up APP in Google Developer Console.
//Set Redirect URI in Developer Console as [https/http]://<yourdomain>/<folder>/get_oauth_token.php
// eg: http://localhost/phpmail/get_oauth_token.php
$mail->oauthRefreshToken = "1/KyhxXysBX_cqXMKcpE8rv2Db-_1kUnnXnuZJWhEibeE";

//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as
$mail->setFrom('manpreetsandhu1208@gmail.com', 'WorldLink');

//Set who the message is to be sent to
$mail->addAddress($to_email,'WorldLink');

//Set the subject line
$mail->Subject = 'WorldLink';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
$mail->send();
