<?php
session_start();
include '../includes/database_con.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';


if (isset($_POST["sign_up"])) {
    $matric_number = $_POST["matric_number"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $college = $_POST["college"];
    $department = $_POST["department"];
    $whatsapp_number = $_POST["whatsapp_number"];
    $linkedin_profile = $_POST["linkedin_profile"];

    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $address = $_POST['address'];
    $job_status = $_POST['job_status'];

    $profile_picture = $_FILES["profile_picture"];
    $profile_picture_name = $profile_picture['name'];
    $profile_picture_file = $profile_picture['tmp_name'];


    $fetch_data = "SELECT * FROM `users` WHERE matric_number = '$matric_number' OR email = '$email' OR whatsapp_number = '$whatsapp_number'";
    $check = mysqli_query($db_con, $fetch_data);
    $number_check = mysqli_num_rows($check);

    if ($number_check > 0) {
        $exist_data = mysqli_fetch_array($check);
        if ($exist_data['matric_number'] == $matric_number) {
            header('Location: ../registration.php?msg=Matric number already exist&type=error');
        } elseif ($exist_data['email' == $email]) {
            header('Location: ../registration.php?msg=Email already exist&type=error');
        } elseif ($exist_data['whatsapp_number'] == $whatsapp_number) {
            header('Location: ../registration.php?msg=Whatsapp number already exist&type=error');
        }
    } else {

        $insert_data = "INSERT INTO users (matric_number, fullname, email, college, department, address, whatsapp_number, linkedin_profile, profile_picture, job_status, password, confirmed_password) 
        VALUES ('$matric_number','$fullname','$email','$college','$department','$address','$whatsapp_number','$linkedin_profile', '$profile_picture_name','$job_status', '$password','$confirm_password')";

        if ($db_con->query($insert_data) === TRUE) {
            $last_id = $db_con->insert_id;
            $register_for_approval = "INSERT INTO approvals (user_id) VALUES('$last_id')";
            $query_insert = mysqli_query($db_con, $register_for_approval);

            if ($query_insert) {
                header('Location: ../index.php?msg=Registration successful&type=success');
            } else {
                header('Location: ../registration.php?msg=Registration was not successful&type=error');
            }
        }
    }
}

if (isset($_POST['log_in'])) {
    $matric_number = $_POST["matric_number"];
    $password = $_POST["password"];
    $get_data = "SELECT * FROM users WHERE matric_number = '$matric_number' && password = '$password'";
    $query = mysqli_query($db_con, $get_data);
    $data_exist = mysqli_num_rows($query);

    if ($data_exist > 0) {
        $all_data = mysqli_fetch_array($query);

        if ($all_data['email_confirmation'] == '0') {
            $user_email = $all_data['email'];
            $matric_number = $all_data['matric_number'];
            $_fullname = $all_data['fullname'];

            $token = rand(000000, 999999);

            $updateInfo = "UPDATE users SET token= '$token' WHERE matric_number = '$matric_number'";
            $updateInfo_info = mysqli_query($db_con, $updateInfo);

            //Load Composer's autoloader
            require '../vendor/autoload.php';

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
                $mail->addAddress($user_email, $fullname);     //Add a recipient           //Name is optional
                $mail->addReplyTo('info.suab@summituniversity.edu.ng', 'Suab');
                $mail->addBCC('info.suab@summituniversity.edu.ng');

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Email Verification';
                $mail->Body    = 'You this token <b>' . $token . '</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header('Location: ../email_confirmation.php?msg=Please enter the token sent your email now&type=error&request_token=true');
            } catch (Exception $e) {
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                header('Location: ../index.php?msg=Message could not be sent.&type=error&request_token=true');
            }
        } else {
            $_SESSION['email'] = $all_data['email'];
            $_SESSION['matric'] = $all_data['matric_number'];
            $_SESSION['id'] = $all_data['id'];
            $_SESSION['auth'] = true;
            header('location:../dashboard.php');
        }
    } elseif (!$data_exist > 0) {
        $_SESSION['invalid_info'] = "invalid data provided";
        header('Location: ../index.php?msg=You just provided wrong informations&type=error');
    }
}

if (isset($_POST['confirm_mail'])) {
    $token = $_POST["token"];
    $get_data = "SELECT * FROM users WHERE token = '$token'";
    $query = mysqli_query($db_con, $get_data);
    $data_exist = mysqli_num_rows($query);

    if ($data_exist > 0) {
        $all_data = mysqli_fetch_array($query);
        $_SESSION['email'] = $all_data['email'];
        $_SESSION['matric'] = $all_data['matric_number'];
        $_SESSION['id'] = $all_data['id'];
        $_SESSION['auth'] = true;

        $matric_number = $_SESSION['matric'];

        $updateInfo = "UPDATE users SET email_confirmation= '1' WHERE matric_number = '$matric_number'";
        $updateInfo_info = mysqli_query($db_con, $updateInfo);

        header('location:../dashboard.php');
    } else {
        header('Location: ../email_confirmation.php?msg=Wrong token informations&type=error');
    }
}
