<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/autoload.php';

    $formErr = "";

    if($_POST) {
        if (empty($_POST["email"])) {
            $formErr = "Email is required";
        } else {
            $email = $_POST["email"];
            $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                $formErr = "There are no accounts with that email.";
            } else {
                // do stuff
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