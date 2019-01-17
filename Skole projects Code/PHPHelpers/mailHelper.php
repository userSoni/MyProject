<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/phpmailer/src/Exception.php';
require 'C:/xampp/htdocs/phpmailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/phpmailer/src/SMTP.php';

$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";

$emailAddressTo = "";

$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd");

$sql = "SELECT * from Kunder where ID = " . $_POST["KundeID"];

if ($result = $conn->prepare($sql))
{
	$result -> execute();
	if ($row = $result -> fetch(PDO::FETCH_ASSOC)){
		$emailAddressTo = $row["Email"];
	}
	else
	{
		echo "Fejl: Brugeren findes ikke i databasen.";
	}
}
else
{
	echo "Fejl: Database connectionen mislykkedes.";
}

$attachmentPath = "";
$bodyTo = $_POST["bodyTo"];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'tobironson@gmail.com';                 // SMTP username
    $mail->Password = 'tectoroso';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('tobironson@gmail.com', 'TEC - SKP Servicedesk');
    $mail->addAddress($emailAddressTo);     // Add a recipient

    //Attachments
	if($attachmentPath != "")
	{
		$mail->addAttachment($attachmentPath);         // Add attachments
	}
	
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Ny PC parat."; 
    $mail->Body = $bodyTo;
	
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>