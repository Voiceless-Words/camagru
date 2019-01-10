<?php
include('../database.php');

if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $token = bin2hex(openssl_random_pseudo_bytes(64));
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/html; charset=iso-8859-1";
    $link = "
        <p>Follow the link you are now a step closer to all you need to do is
        to click<a href='http://localhost:8080/camagrus/login/change_pass.php?email=$email&token=$token'> here</a> to change your
         password</p>
         <br><br>
         <p>Kind Regards, <br> Camagru</p>";

    $query = $connect->prepare("SELECT `email` FROM `Camagru`.`users` WHERE `email` = ?");
    $query->execute(array($email));
    if ($result = $query->fetchAll()) {
        foreach ($result as $row) {
            if ($row["email"] == $email) {

                mail($email, "Change Password", $link, implode("\r\n", $headers));
                //header("Location:change_pass.php");
                echo  "nothing";
            }else{
                echo "success";
            }
        }
    } else {

        echo "success";
    }
}else{
    echo "success";
}