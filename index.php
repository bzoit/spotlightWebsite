<?php
    $loginErr = "";
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("Location: ./feed.php");
        die();
    }

    include('config.php');

    if ($_POST) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            $loginErr = "The email or password is incorrect.";
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['token'] = $result['token'];
                $_SESSION['loggedin'] = true;
                header("Location: ./feed.php");
                die();
            } else {
                $loginErr = "The email or password is incorrect.";
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
    <title>Spotlight | Login</title>
    <link rel="icon" href="img/logo-icon.png">
</head>
<body>
    <div id="loginHeader">
        <h1 aria-label="Spotlight">Spotlight</h1>
        <h2>Show the world your appreciation for the ones that mean the most to you.</h2>
    </div>
    <div class="form-container">
        <form method="post" id="loginForm">
            <span><?php echo $loginErr; ?></span>
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <a href="forgotPass.php">Forgot Password?</a>
            <input type="submit" class="button" value="Login">
        </form>
    </div>
    <div id="signupContainer">
        <a href="./signup.php">Don't have an account? Sign up now.</a>
    </div>
</body>
</html>