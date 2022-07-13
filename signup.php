<?php
    $signupErr = "";
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
  <form id="signupForm">
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