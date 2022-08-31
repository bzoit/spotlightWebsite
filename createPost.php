<?php
    $postErr = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="account.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">
    <title>Spotlight | Create Post</title>
    <link rel="icon" href="img/logo-icon.png">
</head>
<body>
    <h1>Create a Post</h1>
    <div id="createCntr" class="form-container">
        <form method="post" id="postForm">
            <span><?=$postErr?></span>
            <input id="fileUpload" type="file" name="image" accept="image/png, image/jpeg, image/jpg">
            <input name="name" type="text" placeholder="Full Name">
            <input placeholder="Link (optional)" type="text" name="link">
            <textarea name="msg" placeholder="Message"></textarea>
            <a href="./index.php">Already have an account?</a>
            <p id="previewPost">Preview Post</p>
            <input type="submit" class="button" value="Create Tribute">
        </form>
    </div>
    <div id="previewCntr">
        <img id="pImg" alt="Preview Post Image" />
        <h2 id="pName"></h2>
        <h2 id="pLink"></h2>
        <p id="pMsg"></p>
    </div>
    <script type="text/javascript">
        document.getElementById("fileUpload").addEventListener("change", loadFile);
        document.getElementById("previewPost").addEventListener("click", previewPost);

        function previewPost() {
            let previewCntr = document.getElementById("previewCntr");
            let createCntr = document.getElementById("createCntr");

            if (previewCntr.style.visibility === "hidden") {
                const name = document.getElementsByName("name")[0].value;
                const link = document.getElementsByName("link")[0].value;
                const msg = document.getElementsByName("msg")[0].value;

                previewCntr.style.visibility = "visible";

                document.getElementById("pName").innerHTML = name;
                document.getElementById("pLink").innerHTML = link;
                document.getElementById("pMsg").innerHTML = msg;

                createCntr.style.float = "right";
                createCntr.style.marginRight = "50px";
            } else {
                previewCntr.style.visibility = "hidden";
                createCntr.style.float = "none";
                createCntr.style.margin = "auto";
            }
        }

        function loadFile(event) {
            try {
                document.getElementById("pImg").src = URL.createObjectURL(event.target.files[0]);
            } catch (e) {
                document.getElementById("pImg").removeAttribute("src");
            }
        }
    </script>
</body>
</html>