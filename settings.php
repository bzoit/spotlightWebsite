<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="social.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
    <title>Spotlight | Settings</title>
    <link rel="icon" href="img/logo-icon.jpg">
</head>
<body id="settingsBody">
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="settings.php">Settings</a>
        <a href="/">My Posts</a>
        <a href="/">My Comments</a>
        <a href="logout.php">Logout</a>
    </div>

    <span onclick="openNav()">
        <img class="menu" src="img/menu.jpg"  alt="menu"/>
    </span>

    <div id="main">
        <h1>Account Settings</h1>
        <div class="mainContainer">
            <div id="emailText">
                <h2>Email Address</h2>
                <p>user@example.com</p>
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