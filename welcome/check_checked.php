<?php
session_start();
include ("../database.php");
if (isset($_SESSION['emailL'])){
    if ($_POST['check'] == 'yes'){
        $email = $_SESSION["emailL"];
        $query = $connect->prepare("SELECT `notification` FROM `Camagru`.`users` WHERE `username` = ?");
        $query->execute(array($email));
        $result = $query->fetch();
        if ($result['notification'] === '1')
        {
            echo "success";
        }
        else{
            echo "nothing";
        }
    }
    else{
        header("Location: ./");
    }
}else
{
    header("Location: ../");
}