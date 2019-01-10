<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/27
 * Time: 10:30 PM
 */
include("../database.php");

$email = $_GET["email"];
$token = $_GET["token"];
$val = 1;
$query = $connect->prepare("SELECT `email`, `token`, `token_flag` FROM `Camagru`.`users` WHERE email = ? AND token = ? AND token_flag = 0");
$query->execute(array($email, $token));
if ($result = $query->fetchAll()) {

    foreach ($result as $row) {
        $query = $connect->prepare("UPDATE `Camagru`.`users` SET `token_flag` = ? WHERE `email` = ?");
        $query->execute(array($val, $email));
        print_r($row);

    }
}else{
    echo "Already verified";
}
header("Location: ../");