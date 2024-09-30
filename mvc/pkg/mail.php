<?php
// $path = './phpmailer/src/PHPMailer.php';
// echo $path;
// echo '<br>';
// $currentDir = getcwd();
// echo "Thư mục hiện tại là: " . $currentDir;
// echo '<br>';
// if (file_exists($path)) {
//     echo "Đường dẫn tồn tại!";
// } else {
//     echo "Đường dẫn không tồn tại.";
// }
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/Exception.php';
require './phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendCode($email)
{
    $otp = rand(100000, 999999);

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = "let942217@gmail.com";
    $mail->Password = "yhcb hqcv hwgd fbmf";

    $mail->SMTPSecure = 'tls';

    $mail->Port = 587;

    $mail->setFrom("let942217@gmail.com");
    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = "Email verification Code ($otp)";
    $mail->Body = "Dear User,\n\nYour verification code is:\n\n$otp\n\nPlease use this code to verify your email address.\n\nThank you!\n\nIf you did not request this, please ignore this email.";
    try {
        $mail->send();
        $_SESSION["verify-code"] = $otp;
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function verifyCode($code)
{
    $otp = $_SESSION["verify-code"];
    return $otp == $code;
}
// echo "123";
?>