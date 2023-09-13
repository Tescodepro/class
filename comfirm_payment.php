<?php
include 'isloggedin.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


if (isset($_GET['payment_successful'])) {
    $ref = $_GET['ref'];
    $updatepayment = "UPDATE transactions SET payment_status = 1 WHERE reference = '$ref'";
    $updateQuery = mysqli_query($db_con, $updatepayment);
    if($updateQuery) {


        //Load Composer's autoloader
        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            // $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'tescodepro@gmail.com';                     //SMTP username
            $mail->Password   = 'luzkjwifpswlqxab';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('info.suab@summituniversity.edu.ng', 'Suab');
            $mail->addAddress('info.suab@summituniversity.edu.ng');     //Add a recipient           //Name is optional
            $mail->addReplyTo('info.suab@summituniversity.edu.ng', 'Suab');
            foreach($all_staff as $staff_mail) {
                $mail->addBCC($staff_mail);
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Payment Notification';
            $mail->Body    = 'A student with matric number <b>' . $matric_number . ' just make payment. <br>Thanks</b>';

            $mail->send();
            header('Location: dashboard.php?msg=Payment Successful');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // header('Location: dashboard.php?msg=Message could not be sent.&type=error&request_token=true');
        }
        
    }
}


