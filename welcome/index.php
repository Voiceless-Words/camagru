<!DOCTYPE html>
<html><head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <!--<script src="main.js"></script-->
    <?php
    $row_per_page = 7;
    $row = 0;

    if(isset($_POST['but_prev']))
    {
    $row = $_POST['row'];
    $row -= $row_per_page;
    if ($row < 0)
    {
    $row = 0;
    }
    }

    if (isset($_POST['but_next']))
    {
    $row = $_POST['row'];
    $allcount = $_POST['allcount'];
    $val = $row + $row_per_page;
    if($val < $allcount)
    {
    $row = $val;
    }
    }?>
    <script>
        function showForm() {
            const divElement = document.getElementById("settings");
            if(divElement.style.display === 'none')
            {
                divElement.style.display = 'block';
            }
            else {
                divElement.style.display = 'none';
            }
        }
    </script>
</head>
<body>
<div class="container">
    <div class="head">
        <h1 style="margin-left: 5%">Camagru</h1>
        <div id="logout" >
            <ul>
            <li><a style="text-decoration: none; font-size: 20px; margin-right: 5px; color: black;" href="#">Home</a></li>
            <li><a style="text-decoration: none; font-size: 20px; margin-right: 5px; color: black;" href="../gallery.php">Gallery</a></li>
            <li><a style="text-decoration: none; font-size: 20px; margin-right: 5px; color: black;" href="../myPosts.php">My Posts</a></li>
            <li><a style="text-decoration: none; font-size: 20px; margin-right: 5px; color: black;" href="logout.php">Logout</a></li>
            </ul>
        </div>

    </div>
    <div class="settings">
        <button onclick="showForm()">Settings</button>
        <div id="settings" hidden>
            <form method="POST" action="newPass.php">
                <input type="password" placeholder="New password" name="newPass" id="newPass" required><br>
                <input type="password" placeholder="Confirm new password" id="conPass" required><br>
                <input type="submit" value="Change Password" name="newPassword" id="sub">
            </form>
            <form method="POST" action="newPass.php" onsubmit="submitForm()">
                <input type="email" placeholder="New email" name="newEmail" id="newEmail" required><br>
                <input type="submit" value="Change Email" name="newMail">
            </form>
            <form method="POST" action="newPass.php" onsubmit="submitUser()">
                <input type="text" placeholder="New username" name="newUser" id="newUser" required><br>
                <input type="submit" value="Change Username" name="newSer">
            </form>
            <label style="color: whitesmoke;">Receive Notifications: <input type="checkbox" value="yes" name="check" id="check" onclick="checks()"> </label>
        </div>
        <div>
            <form enctype="multipart/form-data" onsubmit="this.reset(); return false;">
                <input name="image" id="fill" type="file" accept="image/*" required><br>
                <input type="submit" value="Upload image" onclick="uploadPic()">
            </form>
        </div>
    </div>
    <div style="margin-left: 25%; margin-top: 2%">
        <button onclick="document.getElementById('frame2').src ='../trans4.png'; frameChange();">Frame 1</button>
        <button onclick="document.getElementById('frame2').src ='../bubbles2.png'; frameChange();">Frame 2</button>
        <button onclick="document.getElementById('frame2').src ='../trans5.png'; frameChange();">Frame 3</button>
        <button onclick="document.getElementById('frame2').src ='../noframe.png'; frameChange();">No Frame</button>
    </div>
    <div style="margin-left: 25%; margin-top: 2%">
        <button onclick="document.getElementById('frame').src ='../trans4.png'; frameChange();">Frame 1</button>
        <button onclick="document.getElementById('frame').src ='../bubbles2.png'; frameChange();">Frame 2</button>
        <button onclick="document.getElementById('frame').src ='../trans5.png'; frameChange();">Frame 3</button>
        <button onclick="document.getElementById('frame').src ='../noframe.png'; frameChange();">No Frame</button>
    </div>
    <div class="sign">
        <?php
        session_start();
        if  (isset($_SESSION["emailL"])) {
            echo  "<div class='photo' style='width:20%; height: 678px; margin-top: 2%; margin-left: 34%'>
        <video id='vid' style='width:400px; height: 300px;margin-top: 0;' src='' autoplay></video>
        <button id='cap'  style='margin-bottom: 5px;'>Take Photo</button>
        <canvas id='canvas' style='display: none;' width='400px' height='300px'></canvas>
        <canvas id='canvas2' style='display: none;' width='400px' height='300px'></canvas>
        <img id='source' src='../noframe.png' width='400' height='300' alt='photo to be saved'>
        <img src='../noframe.png' id='frame' hidden>
        <img src='../noframe.png' id='frame2' hidden>
        <button id='cap' style='margin-bottom: 5px;' onclick='savePhoto()'>Save Photo</button>
    text-align: center;'>Save Photo</a>
    </div>";
        }
        else{
            header("Location: ../");
        }?>
    </div>
        <?php
        include ("../database.php");
        $sql = "SELECT `user_id` FROM `Camagru`.`users` WHERE `username` = ?";
        $query = $connect->prepare($sql);
        $query->execute([$_SESSION['emailL']]);
        $u_id = $query->fetch();
        $id = $u_id['user_id'];
        $sql = "SELECT COUNT(*) AS nRow FROM `Camagru`.`pics` WHERE `user_id` = ?";
        $query = $connect->prepare($sql);
        $query->execute([$id]);
        $res = $query->fetch();
        $allcount = $res['nRow'];
        $sno = $row + 1;
        $sql = "SELECT * FROM `Camagru`.`pics` WHERE `user_id` = ? ORDER BY `id` ASC limit $row," .$row_per_page;
        $query = $connect->prepare($sql);
        $query->execute([$id]);
        if($allcount > 0) {
            echo "<div style='border: 5px blanchedalmond solid; margin: 0 0 1% 5%; width: 90%; height: 250px'>";
            while ($result = $query->fetch()) {
                $nam = $result['image'];
                echo "<img src='$nam' style='margin-left: 3.3%; margin-top: 2%;display: inline;' width='10%' height='200px'/>";
                $sno++;
            }
            echo "<form method='post' action=''>
                <input type='hidden' name='row' value='$row'>
                <input type='hidden' name='allcount'  value='$allcount'>
                <input type='submit' name='but_prev' value='Previous'>
                <input type='submit' name='but_next' value='Next'>                
                </form>";
        }?>
    </div>
    <div style="margin-bottom: 0;"><?php include "../footer.php";?></div>
</div>
<script src="photo.js?n=1"></script>
<script src="new_pass.js?n=1"></script>

</body>
</html>
