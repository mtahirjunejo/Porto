<?php

use PHPMailer\PHPMailer;
use PHPMailer\Exception;
use PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(empty($_POST))
{
    header("Location: index.php");
    die();
}else {

    $html = '';
    $html .= '<table>';
    $html .= '<tbody>';
    // $html .= '<tr>';
    
    foreach ($_POST as $key => $post_value){
        $post_keys = str_replace('_',' ',ucwords($key,'_'));
        $html .= '<tr>';
        $html.= "<th style='text-align:left;''>" .$post_keys.":</th> <td>" . $post_value ."</td><br>";
        $html .= '</tr>';
    }
    // $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';

    $mail = new PHPMailer();
    try {

        $body = $html;
        $mail->SMTPDebug = 0;                 //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '@';                   //SMTP username
        $mail->Password   = '';                       //SMTP password
        $mail->SMTPSecure = "ssl";
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('lead@mteejay.com' , 'Contact us form');
        $mail->addAddress('.uk@gmail.com');             //Name is optional
        $mail->addAddress('admin@.com');             //Name is optional
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New Lead Submitted For Website';
        $mail->Body    = $body;
        if ($mail->Send()) { 
           echo  "<script>window.location = '/' </script>"; 

        }

        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


}



 ?>
