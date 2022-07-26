<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    include('config.php');

    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("Location: ./login.php");
        die();
    }

    $link = "<a href='http://192.168.64.3/tribute/verify.php?token='".$_SESSION["token"].">Click here</a>";

    $query = $connection->prepare("SELECT email FROM users WHERE token=:token");
    $query->bindParam("token", $_SESSION["token"], PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    print_r($_SESSION["token"]);

    $mail = new PHPMailer(true);

    try {
        $mail->CharSet = "utf-8";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Username = "wht.finance7@yahoo.com";
        $mail->Password = "B0zzMan179!";
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.mail.yahoo.com";
        $mail->Port = "465";                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('wht.finance7@yahoo.com');
        $mail->addAddress($result['email']);
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Spotlight Account Verification';
        $mail->Body = 'Hello! Your email, ' . $result['email'] . ", has been used to register a Spotlight account. Now, you just have to verify your email address. " . $link . ' to verify.';
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>
