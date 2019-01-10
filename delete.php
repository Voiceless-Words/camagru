<?php

include("database.php");
session_start();

if(isset($_SESSION['emailL'])) {
    $email = $_SESSION['emailL'];
    /*$query = $connect->prepare("SELECT `user_id` FROM `Camagru`.`users` WHERE `username`= ?");
    $query->execute(array($email));
    $result = $query->fetch();
    $id = $result['user_id'];*/

    if (isset($_POST['image_id'])) {
        $image_id = $_POST["image_id"];
        $sql = "DELETE FROM `Camagru`.`pics` WHERE `id` = ?";
        $query = $connect->prepare($sql);
        $query->execute(array($image_id));
        echo "success";
        header("Location: myPosts.php");
    }
    else {
        echo 'nothing';
    }
}else
{
    header("Location: ./");
}

