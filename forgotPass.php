<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    include ('config.php');

    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/autoload.php';

    $formErr = "";

/**
 * @param PHPMailer $mail
 * @return void
 * @throws Exception
 */

if($_POST) {
        if (empty($_POST["email"])) {
            $formErr = "Email is required.";
        } else {
            $email = $_POST["email"];
            $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                $formErr = "There are no accounts with that email.";
            } else {
                $link = "<a href='http://192.168.64.3/tribute/forgotForm.php?token='".$_SESSION["token"].">Click here</a>";
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
                    $mail->addAddress($email);
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Reset Spotlight Password';
                    $mail->Body = 'Forgot your password? No worries, changing it is easy. ' . $link . ' to reset it.';
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
    <h1 id="forgotHeader">Forgot Password?</h1>
    <div class="form-container">
        <form method="post" id="forgotForm">
            <span><?php echo $formErr; ?></span>
            <input name="email" type="email" placeholder="Email Address">
            <input type="submit" class="button" value="Submit">
        </form>
    </div>
</body>
</html>