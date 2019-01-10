<?PHP

//creates all the tables and database

include('database.php');
try
{

    $connect->query('CREATE DATABASE IF NOT EXISTS `Camagru`');
    $connect->query("CREATE TABLE IF NOT EXISTS `Camagru`.`users` (
    `user_id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `first_name` VARCHAR(25) NOT NULL,
    `username` VARCHAR(25) NOT NULL UNIQUE ,
    `pass` VARCHAR(255) NOT NULL, 
    `email`  VARCHAR(255) NOT NULL UNIQUE ,
    `notification` INTEGER(1),
    `token` VARCHAR(255),
    `token_flag` INTEGER(1),
    `date` TIMESTAMP
    )");
    $connect->query("CREATE TABLE IF NOT EXISTS `Camagru`.`comments` (
    `comment_id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(255) NOT NULL ,
    `image_id` INTEGER NOT NULL ,
    `comment` VARCHAR(255) NOT NULL, 
    `date` TIMESTAMP
    )");
    $connect->query("CREATE TABLE IF NOT EXISTS `Camagru`.`pics` (
    `id` INTEGER(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INTEGER(11),
    `image` longblob NOT NULL, 
    `comment` varchar(255)
    )");
    $connect->query("CREATE TABLE IF NOT EXISTS `Camagru`.`likes` (
    `id` INTEGER(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(255) NOT NULL ,
    `image_id`INTEGER(11) NOT NULL ,
    `like` INTEGER(1), 
    `date` TIMESTAMP
    )");
}
catch(PDOException $e)
{

    echo $e->getMessage();
    die();

}
echo "<a href='./' style='text-decoration: none;'>setup complete you can click here to proceed to the site</a>";