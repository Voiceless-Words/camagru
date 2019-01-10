<?php

include("database.php");
session_start();

if(isset($_SESSION['emailL'])) {
    $email = $_SESSION['emailL'];
    /*$query = $connect->prepare("SELECT `user_id` FROM `Camagru`.`users` WHERE `username`= ?");
    $query->execute(array($email));
    $result = $query->fetch();
    $id = $result['user_id'];*/

    if (isset($_POST['comment']) && isset($_POST['image_id'])) {
        $image_id = $_POST["image_id"];
        $comment = htmlentities($_POST['comment']);
        $sql = "INSERT INTO `Camagru`.`comments`(`username`, `image_id`, `comment`, `date`) VALUES(?, ?, ?, NOW())";
        $query = $connect->prepare($sql);
        $query->execute(array($email, $image_id, $comment));
        $query1 = $connect->prepare("SELECT `user_id` FROM `Camagru`.`pics` WHERE `id` = ?");
        $query1->execute(array($image_id));
        $result = $query1->fetch();
        $id = $result['user_id'];
        $query1 = $connect->prepare("SELECT `username`, `email`, `notification` FROM `Camagru`.`users` WHERE `user_id` = ?");
        $query1->execute([$id]);
        $result1 = $query1->fetchAll();
        foreach($result1 as $row)
        {
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-Type: text/html; charset=iso-8859-1";
            $link = "
            <p> $email Has commented on your picture.</p>
            <br><br>
            <p>Kind Regards, <br> Camagru</p>";
            if ($row['notification'] === "1" && $row['username'] !== $email) {
                mail($row['email'], "Someone Left a Comment", $link, implode("\r\n", $headers));
            }
        }
        echo "success";
        header("Location: gallery.php");
    }
    else if (isset($_POST['like1'])) {
        $image_id = $_POST["image_id"];
        $query1 = $connect->prepare("SELECT * FROM `Camagru`.`likes` WHERE `username` = ? AND `image_id` = ?");
        $query1->execute(array($email,$image_id));
        $result = $query1->fetchAll();
        if ($result)
        {
            $sql = "DELETE FROM `Camagru`.`likes` WHERE `username` = ?";
            $query = $connect->prepare($sql);
            $query->execute(array($email));
            header("Location: gallery.php");
        }else {
            $like = 1;
            $sql = "INSERT INTO `Camagru`.`likes`(`username`, `image_id`,`like`, `date`) VALUES( ?, ?, ?, NOW())";
            $query = $connect->prepare($sql);
            $query->execute(array($email, $image_id, $like));
            $query1 = $connect->prepare("SELECT `user_id` FROM `Camagru`.`pics` WHERE `id` = ?");
            $query1->execute(array($image_id));
            $result = $query1->fetch();
            $id = $result['user_id'];
            $query1 = $connect->prepare("SELECT `username`, `email`, `notification` FROM `Camagru`.`users` WHERE `user_id` = ?");
            $query1->execute([$id]);
            $result1 = $query1->fetchAll();
            foreach($result1 as $row)
            {
                $headers[] = "MIME-Version: 1.0";
                $headers[] = "Content-Type: text/html; charset=iso-8859-1";
                $link = "
            <p> $email Liked your picture.</p>
            <br><br>
            <p>Kind Regards, <br> Camagru</p>";
                if ($row['notification'] === "1") {
                    mail($row['email'], "You are killing it!!!!", $link, implode("\r\n", $headers));
                }
            }
            echo "success";
            header("Location: gallery.php");
        }
    }else {
        echo 'nothing';
    }
}else
{
    header("Location: ./");
}

