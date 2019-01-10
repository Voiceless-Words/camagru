<?PHP
include('../database.php');

if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $query1 = $connect->prepare("SELECT `email` FROM `Camagru`.`users` WHERE `username` = ? ");
    $query1->execute([$username]);
    $query = $connect->prepare("SELECT `email` FROM `Camagru`.`users` WHERE email = ? ");
    $query->execute([$email]);
    if ($result1 = $query1->fetchAll())
    {
        echo "user";
    }else if ($result = $query->fetchAll()) {
        echo "email";
    } else if ($result = $query->fetchAll() && $result1 = $query1->fetchAll()){

        echo "both";
    }
    else{
        echo "success";
    }
}
else{
    header("Location: ../");
}
