<?php
    $loginErr = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
    <title>Spotlight | Login</title>
    <link rel="icon" href="img/logo-icon.jpg">
</head>
<body>
    <div id="loginHeader">
        <h1>Spotlight</h1>
        <h2>Show the world your appreciation for the ones that mean the most to you.</h2>
    </div>
    <div class="form-container">
        <form id="loginForm">
            <span><?php echo $loginErr; ?></span>
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <a href="/">Forgot Password?</a>
            <input type="submit" class="button" value="Login">
        </form>
    </div>
    <div id="signupContainer">
        <a href="./signup.php">Don't have an account? Sign up now.</a>
    </div>
</body>
</html>