<?php
require_once('PHPMailer/class.phpmailer.php');

/**************************************************/
/*		      GESTY                       */
/**************************************************/

// Create the mysql backup file
// edit this section
$dbhost = "localhost"; // usually localhost
$dbuser = "root";
$dbpass = "azerty1234";
$dbname = "gesty";
$sendto = "romain@wildcodeschool.fr";
$sendfrom = "gesty@wildcodeschool.fr";
$fromName = "Automated Gesty Backup";
$sendsubject = "Daily Mysql Gesty Backup";
$bodyofemail = "Here is the daily backup.";

$backupfile = $dbname . date("Y-m-d") . '.sql';
system("mysqldump -h $dbhost -u $dbuser -p$dbpass $dbname > $backupfile");

// Mail the file
$email = new PHPMailer();
$email->From		= $sendfrom;
$email->fromName	= $fromName;
$email->Subject 	= $sendsubject;
$email->Body 		= $bodyofemail;
$email->AddAddress($sendto);
$email->AddAttachment( $backupfile );
if ($email->send()) echo "Email sent to ".$sendto."\n";
else echo "Email was not sent\n";

// Delete the file from your server
unlink($backupfile);

?>
