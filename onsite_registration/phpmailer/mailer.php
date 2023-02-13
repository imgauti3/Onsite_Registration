<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.elbonmeetings.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'noreply@elbonmeetings.com';                 // SMTP username
    $mail->Password = 'noreply123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('developer@expoconmedia.com', 'Developer');
    //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('eswar.abhi1210@gmail.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('designer@expoconmedia.com');
  //  $mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = "
<html>
<head>
<title>WE Local India 2018</title>
</head>
<body>
    <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tbody>
        <tr>
            <td>
                <table width='955' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tbody><tr>
                        <td><img src='https://elbonmeetings.com/swe2018/mail_header.jpg' class='CToWUd' style='width: 100%;'></td>
                    </tr>
                </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td height='35'>
                <table width='955' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tbody><tr>
                        <td width='436' bgcolor='#63afb9'>
                            <table width='955' border='0' align='center' cellpadding='12' cellspacing='0'>
                                <tbody><tr>
                                    <td width='720' style='font-family:Trebuchet MS,Arial,Helvetica,sans-serif;font-size:20px' bgcolor='#63afb9'><strong style='color:#fff'>Welcome to 2018 <span class='il'>WE Local India in Pune</span> </strong></td>
                                    <td width='215' height='35' bgcolor='#63afb9'>&nbsp;</td>
                                </tr>
                            </tbody>
                 </table>
               </td>
          </tr>
<tr>
            <td height='350' valign='top'>
                <table width='955' border='0' align='center' cellpadding='0' cellspacing='1' bgcolor='#63afb9'>
                    <tbody><tr>
                        <td bgcolor='#FFFFFF'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='15'>
                                <tbody><tr>
                                    <td>
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                            <tbody><tr>
                                                <td width='90%' valign='top' style='font-family:Trebuchet MS,Arial,Helvetica,sans-serif;font-size:13px'>
                                                    <p>
                                                        Dear  ".ucfirst($name).",
                                                    </p>
                                                    <p><strong>2018 WE Local India in Pune welcomes you!</strong></p>
                                                    <p>	Greetings from the 2018 WE Local India in Pune registration secretariat.</p>
                                                    <p> Thank you for registering for 2018 WE Local India in Pune Conference from 21st March 2018 to 23rd March 2018 at Hyatt Regency, Pune </p>
                                                    <p> We confirm your submitted details as below. Please note the details of your payment: </p>
                                        <table border='0' cellpadding='10' cellspacing='1' bgcolor='#63afb9' width='100%'>
                                            <tbody><tr>
                                                <td width='25%' bgcolor='#FFFFFF'>Delegate Registration ID</td>

                                                <td width='75%' bgcolor='#FFFFFF'>".$_SESSION['cust_id']."</td>
                                            </tr>
                                            <tr>
                                                <td bgcolor='#FFFFFF'>Amount Payable</td>
                                                <td bgcolor='#FFFFFF'> INR ".$amount."</td>
                                            </tr>
                                            <tr>
                                                <td bgcolor='#FFFFFF'>Participant Category</td>
                                                <td bgcolor='#FFFFFF'> ".$_SESSION['reg_type']."</td>
                                            </tr>
                                            <tr>
                                                <td bgcolor='#FFFFFF'>Payment Mode</td>
                                                <td bgcolor='#FFFFFF'>Online Payment</td>
                                            </tr>
                                           
                                        </tbody></table>                                                     
                                                    <pre style='
    font-family: inherit;
'>
Please feel free to contact us at praveenkokne@elbonmeetings.com should you have any queries.

Stay updated with the conference, please visit the website: <a href='https://welocal.swe.org/pune' target='blank'>https://welocal.swe.org/pune/ </a>

We look forward to welcoming you at the conference.
	
Please note that this email is also a receipt for your conference fees payment.
You are required to carry a print out of this email and a valid photo identity card
with you at the time of reporting to the conference. If there is any discrepancy 
please bring it to our attention immediately by writing to us at praveenkokne@elbonmeetings.com. 
Please use an appropriate subject line for all your email communications.

The conference confirmation and registration id is unique and non-transferable.
                                                    
                                                    </pre>

                                                    <p>	Best wishes, <br>
									
									<strong>Team 2018 WE Local India in Pune.</strong></p>                                                                                                      
                                                </td>

                                            </tr>
                                        </tbody>
                                        </table>


                                    </td>
                                </tr>
                            </tbody>
                            </table>
                          </td>
                       </tr>   
                       <tr> 
                </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td valign='top'>
                <table width='955' border='0' align='center' cellpadding='10' cellspacing='0'>
                    <tbody><tr>
                        <td align='center' valign='top'>

                            <p style='font-family:Tahoma,Geneva,sans-serif;font-size:11px'>
                                <strong>Contact & Address: </strong><br>
	Mr. Praveen Kumar Kokne | Sr Manager | Meetings & Conferences 
    Elbon Meetings & Conferences,
	1st Floor, Hitex Trade Fair Office Building
	Hitex Exhibition Centre, Izzatnagar, Madhapur
	Hyderabad 500 084
	M: (+91-8826266168) 


                            </p>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>       
        </tbody>
        </table>
</body>
</html>
";
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>