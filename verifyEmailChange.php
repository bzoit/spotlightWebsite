<?php
    session_start();

    $formErr = "";

    include('config.php');
    include('generateToken.php');


    if($_GET) {
        $_SESSION['token'] = $_GET['token'];

        if($_POST) {
            $token = $_SESSION['token'];
            $newEmail = $_POST['newEmail'];
            $confEmail = $_POST['confEmail'];

            $newToken = generateRandomString($connection);

            if (empty($newEmail) || empty($confEmail)) {
                $formErr = "All fields are required.";
            } elseif ($newEmail != $confEmail) {
                $formErr = "Emails do not match.";
            } else {
                $query = $connection->prepare("UPDATE users SET email=:newEmail, token=:newToken WHERE token=:token");
                $query->bindParam("newEmail", $newEmail, PDO::PARAM_STR);
                $query->bindParam("newToken", $newToken, PDO::PARAM_STR);
                $query->bindParam("token", $token, PDO::PARAM_STR);
                $query->execute();
                header("Location: index.php");
                die();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spotlight | Change Email</title>
    <link rel="icon" href="img/logo-icon.jpg">
    <link rel="stylesheet" href="account.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
</head>
<body>
<h1 id="forgotHeader">Change Email Address</h1>
<div class="form-container">
    <form method="post" id="forgotForm">
        <span><?php echo $formErr; ?></span>
        <input name="newEmail" type="email" placeholder="New Email">
        <input name="confEmail" type="email" placeholder="Confirm New Email">
        <input class="button" type="submit" value="Submit">
    </form>
</div>
</body>
</html>