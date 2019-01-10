<?PHP
include('../database.php');

if (isset($_POST['username'])) {

    $username = $_POST['username'];
    $query = $connect->prepare("SELECT `username` FROM `Camagru`.`users` WHERE username = ? ");
    $query->execute([$username]);
    if ($result = $query->fetch()) {
        echo "nothing";
    }
    else{
        echo "success";
    }
}
else{
    header("Location: ../");
}
