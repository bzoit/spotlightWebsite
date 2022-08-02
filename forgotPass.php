<?php
    include ('config.php');
    use Sendpulse\RestApi\ApiClient;
    require 'vendor/autoload.php';

    $formErr = "";

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
                $link = "<a href='http://192.168.64.3/tribute/forgotForm.php?token='" . $_SESSION["token"] . ">Click here</a>";

                define('API_USER_ID', '');
                define('API_SECRET', '');

                $SPApiClient = new ApiClient(API_USER_ID, API_SECRET);

                $mail = array(
                    'text' => 'Forgot your password? No worries, changing it is easy. ' . $link . ' to reset it.',
                    'subject' => 'Reset Spotlight Password',
                    'from' => array(
                        'name' => 'Spotlight',
                        'email' => 'sender@example.com',
                    ),
                    'to' => array(
                        array(
                            'name' => $email,
                            'email' => $email,
                        ),
                    ),
                );
                var_dump($SPApiClient->smtpSendMail($mail));

                header('Location: forgotCheck.html');
                die();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="account.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
    <title>Spotlight | Forgot Password</title>
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