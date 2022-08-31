<?php
    session_start();

    use Sendpulse\RestApi\ApiClient;
    require 'vendor/autoload.php';
    include('config.php');

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("Location: ./index.php");
        die();
    }

    $link = "<a href='http://192.168.64.3/tribute/verify.php?token='".$_SESSION["token"].">Click here</a>";

    $query = $connection->prepare("SELECT email FROM users WHERE token=:token");
    $query->bindParam("token", $_SESSION["token"], PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    define('API_USER_ID', '');
    define('API_SECRET', '');

    $SPApiClient = new ApiClient(API_USER_ID, API_SECRET);

    $email = array(
        'text' => 'Hello! Your email, ' . $result['email'] . ", has been used to register a Spotlight account. Now, you just have to verify your email address. " . $link . ' to verify.',
        'subject' => 'Spotlight Account Verification',
        'from' => array(
            'name' => 'Spotlight',
            'email' => 'sender@example.com',
        ),
        'to' => array(
            array(
                'name' => $result['email'],
                'email' => $result['email'],
            ),
        ),
    );
    var_dump($SPApiClient->smtpSendMail($email));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="account.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
    <title>Spotlight | Verify Email</title>
    <link rel="icon" href="img/logo-icon.png">
</head>
<body id="emailCheck">
    <h1>We've emailed you instructions to verify your Spotlight account. If you did not receive the email, please check your spam/junk folder or <a href="verifyEmail.php">click here</a> to resend it.</h1>
</body>
</html>