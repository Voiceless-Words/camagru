<?PHP

/*try{
    $connect = new PDO('mysql:host=localhost;dbname=users', 'root', 'piet12345');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e)
{
    echo $e->getMessage();
    die();
}

/* using PDO::FETCH_OBJ allows you to get easy access to all the info
with the table  for arrays you can use FETCH_NUM for numeric arrays
you can use FETCH_ASSOC for associative arrays*/
/*while($rows = $query->fetch(PDO::FETCH_OBJ))
{
    echo $rows->user_name, '<br>';
}
class UserEntry{
    public $user_name, $user_pass, $entry;   
    public function __construct(){
        $this->entry = "$this->user_name posted: $this->user_pass";
    }
}
$query = $connect->query('SELECT * FROM user');
/*you can also fetch all results
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if ($res)
{
    echo '<pre>', print_r($res), '</pre>';
    echo 'everything is here intact<br>';
} 
else
{
    echo 'nothing in the database<br>';
}
echo "Done\n";
//print_r(PDO::getAvailableDrivers());// gets an array of drivers that are available*/

session_start();
if (isset($_SESSION['emailL'])) {
    $email = $_SESSION['emailL'];
    echo "<!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset=\"utf-8\" />
                            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                            <title>Sign up</title>
                            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                            <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"main.css\" />";
    $row_per_page = 5;
    $row = 0;

    if (isset($_POST['but_prev'])) {
        $row = $_POST['row'];
        $row -= $row_per_page;
        if ($row < 0) {
            $row = 0;
        }
    }

    if (isset($_POST['but_next'])) {
        $row = $_POST['row'];
        $allcount = $_POST['allcount'];
        $val = $row + $row_per_page;
        if ($val < $allcount) {
            $row = $val;
        }
    }

    echo " </head>
                        <body>
                            <div style='width: 100%; height: 600px;'>
                                <div class=\"head\">
                                    <h1 style=\"margin-left: 5%\">Camagru</h1>
                                    <div id=\"logout\" >
                                         <ul>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"welcome\">Home</a></li>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"#\">Gallery</a></li>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"myPosts.php\">My Posts</a></li>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"welcome/logout.php\">Logout</a></li>
                                         </ul>
                                    </div>
                                </div>";
    include("database.php");
    $sql = "SELECT COUNT(*) AS nRow FROM `Camagru`.`pics`";
    $query = $connect->prepare($sql);
    $query->execute();
    $res = $query->fetch();
    $allcount = $res['nRow'];
    $sql = "SELECT * FROM `Camagru`.`pics` ORDER BY `id` ASC limit $row," . $row_per_page;
    $query = $connect->prepare($sql);
    $query->execute();
    $sno = $row + 1;
    // while ($fetch = $query->fetch()) {
    while ($result = $query->fetch()) {
        $nam = $result['image'];
        echo "<img src='$nam' style='margin-left: 3.3%; margin-top: 2%; height: 300px; width: 400px;'/>";
        $sql1 = "SELECT * FROM `Camagru`.`comments` WHERE `image_id` = $result[id]";
        $query1 = $connect->prepare($sql1);
        $query1->execute();
        $count = 1;
        while ($result1 = $query1->fetch()) {
            if ($count % 2 == 0) {
                echo "<p style='color: black; line-height: 17px; margin: 0.5% 0 0 3.3%; width: 21%;font-family: sans-serif;  background: whitesmoke;'> <sub style='font-size: 9px; float: left;'>$result1[username] wrote </sub> --$result1[comment] <sup style='font-size: 9px; float: right;'>$result1[date]</sup></p>";
            } else {
                echo "<p style='color: black; line-height: 17px; margin: 0.5% 0 0 3.3%; width: 21%; background: grey;'><sub style='font-size: 9px; float: left;'>$result1[username] wrote </sub> --$result1[comment] <sup style='font-size: 9px; float: right;'>$result1[date]</sup></p>";
            }
            $count++;
        }
        $sql2 = "SELECT `image_id`, `username` FROM `Camagru`.`likes` WHERE `image_id` = $result[id]";
        $query2 = $connect->prepare($sql2);
        $query2->execute();
        $result2 = $query2->fetchAll();
        $check1 = 0;
        if (count($result2) > 0) {
            foreach ($result2 as $check) {
                if ($check['username'] == $email) {
                    $check1 = 1;
                }
            }
            echo "<form method='POST' action='saveComment.php' onsubmit='this.submit();'>";
            echo "<input name='image_id' id='image_id' type='hidden' value='$result[id]'>";
            if (count($result2) == 1 && $check1 == 1) {
                echo "<p style='color: whitesmoke;margin-left: 2.5%;'> You liked this picture ";
                echo "</p>";
            } else if ($check1 == 1) {
                echo "<p style='color: whitesmoke; margin-left: 2.5%;'> You and ";
                echo count($result2) - 1;
                echo " others liked the pic</p>";
            } else {
                echo "<p style='color: whitesmoke;margin-left: 2.5%;'>";
                echo count($result2);
                echo " &nbsp liked the pic</p>";

            }
            echo "<<input type='submit' name='like1' value='Like' style='margin: 0 0 0 2.5%'>";
            echo "</form>";
        } else {
            echo "<form method='POST' action='saveComment.php' onsubmit='this.submit();'>";
            echo "<input name='image_id' id='image_id' type='hidden' value='$result[id]'>";
            echo "<input type='submit' name='like1' value='Like' style='margin: 0.5% 0 0 3.3%'>";
            echo "</form>";
        }
        echo "<form method='POST' action='saveComment.php' onsubmit='this.submit(); this.reset(); return false'>";
        echo "<input name='image_id' id='image_id' type='hidden' value='$result[id]'>";
        echo "<textarea name='comment' id='image_comment' rows='3' cols='64' placeholder='say something about the picture' style='color: whitesmoke; border: none; margin-left: 3.3%'  required></textarea><br>";
        echo "<input style='margin-left: 3.3%;' type='submit' value='Comment'>";
        echo "</form>";
        //echo "<img src='$nam'/>";

        $sno++;
    }
    //}
    if ($allcount > 0) {
        echo "<form method='post' action=''>
                <input type='hidden' name='row' value='$row'>
                <input type='hidden' name='allcount'  value='$allcount'>
                <input type='submit' name='but_prev' value='Previous'>
                <input type='submit' name='but_next' value='Next'>                
                </form>";
    }
    echo "<div style=\"margin-bottom: 0; margin-top: 11%;\">";
    include("footer.php");

    echo "</div>
      </div>";
    echo "<script src='gallery.js?n=1'></script>
      </body>
      </html>";
}else{
    echo "<!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset=\"utf-8\" />
                            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                            <title>Sign up</title>
                            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                            <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"main.css\" />";
    $row_per_page = 5;
    $row = 0;

    if (isset($_POST['but_prev'])) {
        $row = $_POST['row'];
        $row -= $row_per_page;
        if ($row < 0) {
            $row = 0;
        }
    }

    if (isset($_POST['but_next'])) {
        $row = $_POST['row'];
        $allcount = $_POST['allcount'];
        $val = $row + $row_per_page;
        if ($val < $allcount) {
            $row = $val;
        }
    }

    echo " </head>
                        <body>
                            <div style='width: 100%; height: 600px;'>
                                <div class=\"head\">
                                    <h1 style=\"margin-left: 5%\">Camagru</h1>
                                    <div id=\"logout\" >
                                         <ul>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"./\">Login</a></li>
                                            <li><a style=\"text-decoration: none; font-size: 20px; margin-right: 5px; color: black;\" href=\"gallery.php\">Gallery</a></li>
                                         </ul>
                                    </div>
                                </div>";
    include("database.php");
    $sql = "SELECT COUNT(*) AS nRow FROM `Camagru`.`pics`";
    $query = $connect->prepare($sql);
    $query->execute();
    $res = $query->fetch();
    $allcount = $res['nRow'];
    $sql = "SELECT * FROM `Camagru`.`pics` ORDER BY `id` ASC limit $row," . $row_per_page;
    $query = $connect->prepare($sql);
    $query->execute();
    $sno = $row + 1;
    // while ($fetch = $query->fetch()) {
    while ($result = $query->fetch()) {
        $nam = $result['image'];
        echo "<img src='$nam' style='margin-left: 3.3%; margin-top: 2%; height: 300px; width: 400px;'/>";
        $sql1 = "SELECT * FROM `Camagru`.`comments` WHERE `image_id` = $result[id]";
        $query1 = $connect->prepare($sql1);
        $query1->execute();
        $count = 1;
        while ($result1 = $query1->fetch()) {
            if ($count % 2 == 0) {
                echo "<p style='color: black; line-height: 17px; margin: 0.5% 0 0 3.3%; width: 21%;font-family: sans-serif;  background: whitesmoke;'> <sub style='font-size: 9px; float: left;'>$result1[username] wrote </sub> --$result1[comment] <sup style='font-size: 9px; float: right;'>$result1[date]</sup></p>";
            } else {
                echo "<p style='color: black; line-height: 17px; margin: 0.5% 0 0 3.3%; width: 21%; background: grey;'><sub style='font-size: 9px; float: left;'>$result1[username] wrote </sub> --$result1[comment] <sup style='font-size: 9px; float: right;'>$result1[date]</sup></p>";
            }
            $count++;
        }
        //echo "<img src='$nam'/>";

        $sno++;
    }
    //}
    if ($allcount > 0) {
        echo "<form method='post' action=''>
                <input type='hidden' name='row' value='$row'>
                <input type='hidden' name='allcount'  value='$allcount'>
                <input type='submit' name='but_prev' value='Previous'>
                <input type='submit' name='but_next' value='Next'>                
                </form>";
    }
    echo "<div style=\"margin-bottom: 0; margin-top: 11%;\">";
    include("footer.php");

    echo "</div>
      </div>";
    echo "<script src='gallery.js?n=1'></script>
      </body>
      </html>";
}