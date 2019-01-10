<?php

include("database.php");
session_start();

/*echo $_FILES['image']['tmp_name']."png";

if (move_uploaded_file($_FILES["image"]["tmp_name"], 'p.png')) {
    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}*/

if(isset($_SESSION['emailL'])) {
    $email = $_SESSION['emailL'];
    $query = $connect->prepare("SELECT `user_id` FROM `Camagru`.`users` WHERE `username`= ?");
    $query->execute(array($email));
    $result = $query->fetch();
    $id = $result['user_id'];

    if (isset($_POST['image'])) {
        $image = $_POST["image"];

        $img = preg_replace('#data:image/[^;]+;base64,#', '', $image);
        $result1 = file_put_contents("file2.png", base64_decode($img));
        /*$sql = "INSERT INTO `Camagru`.`pics`(`user_id`, `image`) VALUES(?, ?)";
        $query = $connect->prepare($sql);
        $query->execute(array($id, $image));*/
        echo "success";
    }
    else {
        echo 'nothing';
    }
}else
{
    header("Location: ./");
}

