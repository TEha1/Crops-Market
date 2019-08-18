<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include_once 'adminClass.php';
$admin = new Admin();
$data = $admin->selectManager(1,'Gmail') ;
$Receiver = $data['Gmail'];
$Email= 'lotuscompany22@gmail.com';
$Password= 'lotuscompany123';
$Name = 'Lotus Company';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = $Email;
$mail->Password = $Password;
$mail->setFrom($Email, $Name);
$mail->addAddress($Receiver);
$mail->Subject = 'Order';
