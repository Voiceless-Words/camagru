<?php
include("../database.php");

echo "this is the email".$_POST['email'];

$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$query = $connect->prepare("SELECT `email`, `pass` FROM `Camagru`.`users` WHERE email = ?");
$query->execute(array($email));
if ($result = $query->fetchAll()) {

    foreach ($result as $row) {
        $query = $connect->prepare("UPDATE `Camagru`.`users` SET `pass` = ?");
        $query->execute(array($password));
    }
}else{
    echo "nothing";
}
header("Location: ../");
