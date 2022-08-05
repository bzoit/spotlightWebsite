<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
        header("Location: ./index.php");
        die();
    }

    include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="social.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
  <title>Spotlight | Feed</title>
  <link rel="icon" href="img/logo-icon.jpg">
</head>
<body>
  <div class="dropdown" onclick="showContent()">
    <button class="dropbtn" aria-label="Open Settings Dropdown"><img src="img/user.jpg" alt="User Settings"></button>
    <div class="dropdown-content">
      <a href="settings.php">Settings</a>
      <a href="/">My Posts</a>
      <a href="/">My Comments</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <script>
      function showContent() {
          const content = document.getElementsByClassName("dropdown-content")[0];

          if(content.style.display === "block") {
              content.style.display = "none";
          } else {
              content.style.display = "block";
          }
      }
  </script>
</body>
</html>