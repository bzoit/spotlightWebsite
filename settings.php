<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
        header("Location: ./index.php");
        die();
    }

    include('config.php');

    $token = $_SESSION["token"];

    $query = $connection->prepare("SELECT email FROM users WHERE token=:token");
    $query->bindParam("token", $token, PDO::PARAM_STR);
    $email = $query->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="social.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
    <title>Spotlight | Settings</title>
    <link rel="icon" href="img/logo-icon.png">
</head>
<body id="settingsBody">
    <div id="mySidenav" class="sidenav">
        <a tabindex="-1" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="settings.php">Settings</a>
        <a href="/">My Posts</a>
        <a href="/">My Comments</a>
        <a href="logout.php">Logout</a>
    </div>

    <span onclick="openNav()">
        <img class="menu" src="img/menu.png" alt="menu"/>
    </span>

    <div id="main">
        <h1>Account Settings</h1>
        <div class="mainContainer">
            <div tabindex="1" id="emailText">
                <h2>Email Address</h2>
                <p><?php echo $email; ?></p>
            </div>
            <a id="changeEmail" href="changeEmail.php">Change Email</a>
        </div>
        <a id="resetPass" href="forgotPass.php">Reset Password</a>
    </div>

    <script type="text/javascript">
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>
</html>