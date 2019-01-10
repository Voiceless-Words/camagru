<?php
session_start();
if (isset($_SESSION['emailL']))
{
    include("../database.php");
    $email = $_SESSION["emailL"];
    $newEmail = $_POST['newEmail'];
    $newUser = $_POST['newUser'];
    $password = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
    $query = $connect->prepare("SELECT `email`, `pass` FROM `Camagru`.`users` WHERE `username` = ?");
    $query->execute(array($email));
    if ($result = $query->fetchAll()) {
        foreach ($result as $row) {
            if (isset($_POST['newPassword'])) {
                $query = $connect->prepare("UPDATE `Camagru`.`users` SET `pass` = ?");
                $query->execute(array($password));
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
    <div style='width: 130%;
    height: 300px;'>
        <div class=\"head\">
            <h1 style=\"margin-left: 5%\">Camagru</h1>
        </div>
        <div style='margin-top: 31.5%; margin-left: 20%;'>
            <h2 style='color: whitesmoke;'>Password Changed click <a href='./' style='text-decoration: none; '>here</a> to go back to your profile. </h2>
        </div>";
    include ("../footer.php");
    echo "</div>
</body>
</html>";
            }
            else if (isset($_POST['newMail']))
            {
                $query = $connect->prepare("UPDATE `Camagru`.`users` SET `email` = ? WHERE `username` = ?");
                $query->execute(array($newEmail, $email));
                echo "<!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset=\"utf-8\" />
                            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                            <title>Sign up</title>
                            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                            <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"../main.css\" />
                        </head>
                        <body>
                            <div style='width: 130%;
    height: 300px;'>
                                <div class=\"head\">
                                    <h1 style=\"margin-left: 5%\">Camagru</h1>
                                </div>
                            <div style='margin-top: 31.5%; margin-left: 20%;'>
                                <h2 style='color: whitesmoke;'>Email Changed click <a href='./' style='text-decoration: none; '>here</a> to go back to your profile. </h2>
                            </div>";
                                include ("../footer.php");
                        echo "</div>
                        </body>
                        </html>";
            }
            else if (isset($_POST['newSer']))
            {
                $query = $connect->prepare("UPDATE `Camagru`.`users` SET `username` = ? WHERE `username` = ?");
                $query->execute(array($newUser, $email));
                echo "<!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset=\"utf-8\" />
                            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                            <title>Sign up</title>
                            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                            <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"../main.css\" />
                        </head>
                        <body>
                            <div style='width: 130%;
    height: 300px;'>
                                <div class=\"head\">
                                    <h1 style=\"margin-left: 5%\">Camagru</h1>
                                </div>
                            <div style='margin-top: 31.5%; margin-left: 20%;'>
                                <h2 style='color: whitesmoke;'>Username Changed click <a href='./' style='text-decoration: none; '>here</a> to go back to your profile. </h2>
                            </div>";

                            session_start();
                            unset($_SESSION["emailL"]);
                            session_destroy();
                            header("Location: ../");
                include ("../footer.php");
                echo "</div>
                        </body>
                        </html>";
            }
            else{
                header("Location: ../");
            }
        }
    }
    else{
        header("Location: ./");
    }
}else{
    header("Location: ../");
}