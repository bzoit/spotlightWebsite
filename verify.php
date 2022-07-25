<?php
    session_start();
    include('config.php');

    if($_GET) {
        echo("p");
        $_SESSION['token'] = $_GET['token'];
        $_SESSION['loggedin'] = true;

        function generateRandomString() {
            return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(9/strlen($x)) )),1,9);
        }

        $newToken = generateRandomString();

        $query = $connection->prepare("UPDATE users SET verified = 'true', token = :newToken WHERE token = :oldToken;");
        $query->bindParam("oldToken", $_SESSION['token'], PDO::PARAM_STR);
        $query->bindParam("newToken", $newToken, PDO::PARAM_STR);
        $query->execute();

        header('Location: ./feed.php');
        die();
    }
?>