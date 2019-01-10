<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <!--<script src="main.js"></script-->
</head>
<body>
    <div class="container" style="height: 800px">
        <div class="head">
            <h1 style="margin-left: 5%">Camagru</h1>
            <div id="logout" >
                <ul>
                    <li><a style="text-decoration: none; font-size: 20px; margin-right: 5px; color: black;" href="./">Home</a></li>
                    <li><a style="text-decoration: none; font-size: 20px; margin-right: 5px; color: black;" href="gallery.php">Gallery</a></li>
                </ul>
            </div>
        </div>
        <div>
            <form id="my_form" action="login/welcome.php" method="POST" onsubmit="submit(); this.reset(); return false;">
                <input type="text" name="emailL" placeholder="enter your email" id="emailL" required>
                <input type="password" name="passwordL" placeholder="enter your password" id="passwordL" required>
                <br>
                <input type="submit" value="Login" name="sub" >
                <br >
                <a href="login/" style="text-decoration: none;">Forgot Password?</a>
            </form>
        </div>
            <div style="height: 400px;">
                <form id="sign" action="sign_up/sign_up.php" method="POST" onsubmit="this.submit(); this.reset(); return false;" >
                    <h1 style="color: whitesmoke;">Sign Up Here!!!</h1>
                    <input type="text" name="first_name" placeholder="Enter your first name" required>
                    <br>
                    <input type="text" name="last_name" id="username" placeholder="Enter your user name" required>
                    <br>
                    <input type="email" name="email" placeholder="Enter your email" id="email" required>
                    <br>
                    <input type="email" name="email1" placeholder="Confirm email" id="confirm_email" required>
                    <br>
                    <input type="password" name="pass1" placeholder="Enter your password" id="password" required>
                    <br>
                    <input type="password" name="pass2" placeholder="Confirm password" id="confirm_password" required>
                    <br>
                    <span style="color: whitesmoke;">Receive Notifications:</span> <input type="checkbox" name="notify" value="yes" title="check">
                    <br>
                    <input type="submit" value="Sign Up" name="sub" >
                </form>
            </div>
        <div style="margin-bottom: 0; margin-top: 6%">
            <?php include "footer.php";?>
        </div>
    </div>
    <script src="sign_up/sign_up.js?n=1"></script>
    <script src="login/login.js?n=1"></script>
</body>
</html>
