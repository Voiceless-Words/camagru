<?PHP

include ("database.php");
session_start();
if(isset($_SESSION['emailL'])) {
    $sql = "SELECT `user_id` FROM `Camagru`.`users` WHERE `username` = ?";
    $query = $connect->prepare($sql);
    $query->execute([$_SESSION['emailL']]);
    $u_id = $query->fetch();
    $id = $u_id['user_id'];
    $sql = "SELECT * FROM `Camagru`.`pics` WHERE `user_id` = ?";
    $query = $connect->prepare($sql);
    $query->execute([$id]);
    $num = 0;
    echo "<!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset=\"utf-8\" />
                            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                            <title>Sign up</title>
                            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                            <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"main.css\" />
                        </head>
                        <body>
                            <div style='width: 100%; height: 600px;'>
                                <div class=\"head\">
                                    <h1 style=\"margin-left: 5%\">Camagru</h1>
                                    <div id=\"logout\" >
                                         <ul>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"welcome\">Home</a></li>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"gallery.php\">Gallery</a></li>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"#\">My Posts</a></li>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"welcome/logout.php\">Logout</a></li>
                                         </ul>
                                    </div>
                                </div>";
    while ($result = $query->fetch()) {
        if ($num % 4 == 0) {
            echo "<br>";
        }
        $nam = $result['image'];
        echo "<img src='$nam' style='margin-left: 3.3%; margin-top: 2%;' width='400' height='300'/>";
        $sql1 = "SELECT * FROM `Camagru`.`comments` WHERE `image_id` = $result[id]";
        $query1 = $connect->prepare($sql1);
        $query1->execute();
        $count = 1;
        while ($result1 = $query1->fetch()) {

            if ($count % 2 == 0) {
                echo "<p style='color: black; line-height: 17px; margin: 0.5% 0 0 3.3%; width: 40%;font-family: sans-serif;  background: whitesmoke;'> <sub style='font-size: 9px; float: left;'>$result1[username] wrote </sub> --$result1[comment] <sup style='font-size: 9px; float: right;'>$result1[date]</sup></p>";
            } else {
                echo "<p style='color: black; line-height: 17px; margin: 0.5% 0 0 3.3%; width: 40%; background: grey;'><sub style='font-size: 9px; float: left;'>$result1[username] wrote </sub> --$result1[comment] <sup style='font-size: 9px; float: right;'>$result1[date]</sup></p>";
            }
            $count++;
        }
        echo "<form method='POST' action='delete.php' onsubmit='this.submit(); this.reset(); return false'>";
        echo "<input name='image_id' id='image_id' type='hidden' value='$result[id]'>";
        echo "<input style='margin-left: 3.3%;' type='submit' value='DELETE'>";
        echo "</form>";
        $num++;
        //echo "<img src='$nam'/>";
    }
    echo "<div style=\"margin-bottom: 0; margin-top: 11%;\">";
    include("footer.php");

    echo "</div>
      </div>";
    echo "<script src='gallery.js?n=1'></script>
      </body>
      </html>";
}
else
{
    header("Location: ./");
}