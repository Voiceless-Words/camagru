<?PHP
include('../database.php');
    $uppercase = preg_match('@[A-Z]@', $_POST['pass1']);
    $lowercase = preg_match('@[a-z]@', $_POST['pass1']);
    $digit = preg_match('@[0-9]@', $_POST['pass1']);
    $special = preg_match('/[!@]/', $_POST['pass1']);
    if ($uppercase && $lowercase && $digit && $special && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $_POST['first_name'] != "" && $_POST['last_name'] != "") {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $pass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $token = bin2hex(openssl_random_pseudo_bytes(64));

        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=iso-8859-1";
        $link = "
        <p>Thank you for registering you are now a step closer to all you need to do is
        to click<a href='http://localhost:8080/camagrus/sign_up/email_verify.php?email=$email&token=$token'> here</a> to verify your
         account</p>
         <br><br>
         <p>Kind Regards, <br> Camagru</p>";


        if ($_POST['notify'] == 'yes') {
            $notify = 1;
        } else {
            $notify = 0;
        }
        $sql = "INSERT INTO `Camagru`.`users`(`first_name`, `username`, `pass`, `email`, `notification`, `token`, `token_flag`, `date`) values (?, ?, ?, ?, ?, ?, 0, NOW())";
        $query = $connect->prepare($sql);
        $query->execute(array($first_name, $last_name, $pass, $email, $notify, $token));

        mail($email, "Confirm Email", $link, implode("\n", $headers));
        echo "success added the user";
        header("Location: ../login/welcome.php");
    }
