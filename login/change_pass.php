<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <!--<script src="main.js"></script-->
</head>
<body>
<div class="container">
    <div class="head">
        <h1 style="margin-left: 5%">Camagru</h1>
    </div>
    <div class="sign">
        <form id="change" method="POST" action="password_update.php" onsubmit="this.submit(); this.reset(); return false;">
            <h1 style="color: whitesmoke;">Enter your new password and submit</h1>
            <input type="email" id="email" name="email" value="<?PHP echo $_GET["email"]?>"  title="email" readonly hidden>
            <input type="password" id="password" name="password" placeholder="password" required title="password">
            <input type="password" id="confirm_password" title="confirm_password" placeholder="confirm password" required>
            <input type="submit" value="submit">
        </form>
    </div>
</div>
<script src="change_pass.js?n=1"></script>
<?php include "../footer.php";?>
</body>
</html>