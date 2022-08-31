<?php
    session_start();

    $formErr = "";

    include('config.php');
    include('generateToken.php');


    if($_GET) {
        $_SESSION['token'] = $_GET['token'];

        if($_POST) {
            $token = $_SESSION['token'];
            $newPass = $_POST['newPass'];
            $confPass = $_POST['confPass'];
            $hash = password_hash($newPass, PASSWORD_BCRYPT);

            $newToken = generateRandomString($connection);

            $uppercase = preg_match('@[A-Z]@', $newPass);
            $number = preg_match('@[0-9]@', $newPass);
            $lowercase = preg_match('@[a-z]@', $newPass);
            $specialChars = preg_match('@[^\w]@', $newPass);

            if (empty($newPass) || empty($confPass)) {
                $formErr = "All fields are required.";
            } elseif ($newPass != $confPass) {
                $formErr = "Passwords do not match.";
            } elseif (!$uppercase || !$number || !$lowercase || !$specialChars || strlen($newPass) < 8) {
                $formErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one lowercase letter, one special character, and one number";
            } else {
                $query = $connection->prepare("UPDATE users SET password=:hash, token=:newToken WHERE token=:token");
                $query->bindParam("hash", $hash, PDO::PARAM_STR);
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
    <title>Spotlight | Reset Password</title>
    <link rel="icon" href="img/logo-icon.png">
    <link rel="stylesheet" href="account.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
</head>
<body>
  <h1 id="forgotHeader">Reset Password</h1>
  <div class="form-container">
      <form method="post" id="forgotForm">
          <span><?php echo $formErr; ?></span>
          <input name="newPass" type="password" placeholder="New Password">
          <input name="confPass" type="password" placeholder="Confirm New Password">
          <input class="button" type="submit" value="Submit">
      </form>
  </div>
</body>
</html>