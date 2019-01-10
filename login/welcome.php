<?php
session_start();
if (isset($_POST["emailL"]) && isset($_POST["passwordL"])) {
    $_SESSION["emailL"] = $_POST["emailL"];
    if (isset($_SESSION["emailL"])){
        header("Location: ../welcome");
    }
    exit;
    //header("Location: http://localhost:8080/camagru/login/welcome.php");
} else {
    echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>Sign up</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"../main.css\" />
    <!--<script src=\"main.js\"></script-->
</head>
<body>
    <div style='width: 100%;
    height: 870px;'>
        <div class=\"head\">
            <h1 style=\"margin-left: 5%\">Camagru</h1>
        </div>
        <div id='success'>
            <h2 style='color: whitesmoke;'>Successfully registered your account check your emails to confirm the account and verify the account. </h2>
        </div>
        </div>
<div style='margin-bottom: 0; margin-top: 0; margin-left: 0.3%;'>";
            include "../footer.php";
    echo     "</div>
</body>
</html>";

}

