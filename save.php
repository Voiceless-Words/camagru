<?php

include("database.php");
session_start();

if(isset($_SESSION['emailL'])) {
    $email = $_SESSION['emailL'];
    $query = $connect->prepare("SELECT `user_id` FROM `Camagru`.`users` WHERE `username`= ?");
    $query->execute(array($email));
    $result = $query->fetch();
    $id = $result['user_id'];
    if (isset($_POST['image']) && isset($_POST['image2']) && isset($_POST['image3'])) {
        $img = str_replace("data:image/png;base64,", "",$_POST['image']);
        $result1 = file_put_contents("file1.png", base64_decode($img));
        $destination = imagecreatefrompng('file1.png');
        $src = imagecreatefrompng($_POST['image2']);
        $src1 = imagecreatefrompng($_POST['image3']);
        imagecopy($destination, $src, 0, 0, 0, 0, 400, 300);
        imagecopy($destination, $src1, 0, 0, 0, 0,400, 300);
        $date = imagepng($destination, "file.png");
        imagedestroy($destination);
        imagedestroy($src);
        if(isset($_POST['check'])) {
            $image = base64_encode(file_get_contents("file.png"));
            $image1 = 'data: ' . mime_content_type($image) . ';base64,' . $image;
            $sql = "INSERT INTO `Camagru`.`pics`(`user_id`, `image`) VALUES(?, ?)";
            $query = $connect->prepare($sql);
            $query->execute([$id, $image1]);
        }
        echo "success";
    }
    else if (isset($_POST['image1']) && isset($_POST['image2'])) {
        if(isset($_POST['check'])) {
            $image = base64_encode(file_get_contents("file2.png"));
            $image1 = 'data: ' . mime_content_type($image) . ';base64,' . $image;
            $sql = "INSERT INTO `Camagru`.`pics`(`user_id`, `image`) VALUES(?, ?)";
            $query = $connect->prepare($sql);
            $query->execute([$id, $image1]);
        }
        echo "success";

    }
    else{
        echo "nothing";
    }
}else
{
    header("Location: ./");
}

