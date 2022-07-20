<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/autoload.php';

    $formErr = "";

    print_r($_POST);

    if($_POST["email"]) {
        if (empty($_POST["email"])) {
            $formErr = "Email is required";
        } else {
            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $formErr = "Invalid email format";
            } else {
                $email = $_POST["email"];

                $mail = new PHPMailer();

                try {
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'spotlightnoreply01@gmail.com';                     //SMTP username
                    $mail->Password   = 'B0zzMan137!';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    $mail->setFrom('spotlightnoreply01@gmail.com');
                    $mail->addAddress($email);

                    $mail->Subject = 'Spotlight Password Reset';
                    $mail->Body = 'A Spotlight user is trying to reset your password. If this action was not approved by you, it is strongly advised that you reset your password to prevent your account from being stolen: https://link.com/forgot. If you are trying to reset your password, your code is: 123456.';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
    <title>Spotlight | Forgot</title>
    <link rel="icon" href="img/logo-icon.jpg">
</head>
<body>
    <h1>Forgot Password?</h1>
    <div class="form-container">
        <form method="post" id="forgotForm">
            <span><?php echo $formErr; ?></span>
            <input name="email" type="email" placeholder="Email Address">
            <input type="submit" class="button" value="Submit">
        </form>
    </div>
</body>
</html>