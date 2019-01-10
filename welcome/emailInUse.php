<?PHP
include('../database.php');

if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $query = $connect->prepare("SELECT `email` FROM `Camagru`.`users` WHERE email = ? ");
    $query->execute([$email]);
    if ($result = $query->fetchAll()) {
        echo "nothing";
    }
    else{
        echo "success";
    }
}
else{
    header("Location: ../");
}
