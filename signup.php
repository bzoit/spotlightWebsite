<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
  <title>Spotlight | Signup</title>
  <link rel="icon" href="/">
</head>
<body>
<div>
  <h1>Signup</h1>
</div>
<div class="form-container">
  <form id="signupForm">
    <span><?php echo $signupErr; ?></span>
    <br/>
    <input class="input" name="email" type="email" placeholder="Email">
    <br>
    <input class="input" name="password" type="password" placeholder="Password">
    <br>
    <input class="input" name="confirm" type="password" placeholder="Confirm Password">
    <br>
    <a class="hypertext" href="./index.php">Already have an account?</a>
    <br>
    <input type="submit" class="button" value="Signup">
  </form>
</div>
</body>
</html>