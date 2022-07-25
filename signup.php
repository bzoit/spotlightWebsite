<?php
    // Include config file
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once "config.php";
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/autoload.php';
    session_start();

    // Define variables and initialize with empty values
    $signupErr = "";

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("Location: ./feed.php");
        die();
    }

    // Processing form data when form is submitted
    if($_POST) {
        function generateRandomString() {
            return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(9/strlen($x)) )),1,9);
        }

        $token = generateRandomString();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confPass = $_POST['confirm'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $uppercase = preg_match('@[A-Z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        if(empty($email)) {
            $signupErr = "Email is required.";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $signupErr = "Invalid email address.";
        } elseif(empty($password)) {
            $signupErr = "Password is required.";
        } elseif(!$uppercase || !$number || strlen($password) < 8) {
            $signupErr = "Password should be at least 8 characters in length and should include at least one upper case letter and one number";
        } elseif (empty($confPass)) {
            $signupErr = "Please confirm password.";
        } elseif ($password != $confPass) {
            $signupErr = "Passwords must match.";
        } else {
            $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $signupErr = "Email address already in use.";
            }
            if ($query->rowCount() == 0) {
                $query = $connection->prepare("INSERT INTO users(password,email, token) VALUES (:password_hash,:email, :token)");
                $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $query->bindParam("token", $token, PDO::PARAM_STR);
                $result = $query->execute();
                if ($result) {
                    $_SESSION['token'] = $token;
                    $_SESSION['loggedin'] = true;
                    header("Location: ./verifyEmail.php");
                    die();
                } else {
                    $signupErr = "Something went wrong! Please try again later.";
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
  <title>Spotlight | Signup</title>
  <link rel="icon" href="img/logo-icon.jpg">
</head>
<body>
<div>
  <h1>Signup</h1>
</div>
<div class="form-container">
  <form method="post" id="signupForm">
    <span><?php echo $signupErr; ?></span>
    <input name="email" type="email" placeholder="Email">
    <input name="password" type="password" placeholder="Password">
    <input name="confirm" type="password" placeholder="Confirm Password">
    <a href="./index.php">Already have an account?</a>
    <input type="submit" class="button" value="Signup">
  </form>
</div>
</body>
</html>