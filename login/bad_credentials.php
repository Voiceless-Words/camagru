<?php
/**
 * Created by PhpStorm.
 * User: pragolan
 * Date: 2018/11/02
 * Time: 11:41
 */
include('../database.php');

if (isset($_POST['emailL']) && isset($_POST['passwordL'])) {

    $email = $_POST['emailL'];
    $password = $_POST["passwordL"];

    $query = $connect->prepare("SELECT * FROM `Camagru`.`users` WHERE `username` = ?");
    $query->execute(array($email));
    if ($result = $query->fetchAll()) {
        foreach ($result as $row) {
            if ($row["username"] == $email && password_verify($password, $row["pass"]) && $row['token_flag'] === "1") {
                    echo "success";
            }else if($row["username"] == $email && password_verify($password, $row["pass"]) && $row['token_flag'] === "0"){
                echo "verify";
            }else{
                echo  "nothing";
            }
        }
    } else {
        echo "nothing";
    }
}else{
    header("Location: ../");
}
