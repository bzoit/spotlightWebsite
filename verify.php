<?php
    session_start();
    include('config.php');
    include('generateToken.php');


    if($_GET) {
        echo("p");
        $_SESSION['token'] = $_GET['token'];
        $_SESSION['loggedin'] = true;

        $newToken = generateRandomString($connection);

        $query = $connection->prepare("UPDATE users SET verified = 'true', token = :newToken WHERE token = :oldToken;");
        $query->bindParam("oldToken", $_SESSION['token'], PDO::PARAM_STR);
        $query->bindParam("newToken", $newToken, PDO::PARAM_STR);
        $query->execute();

        header('Location: ./login.php');
        die();
    }
?>