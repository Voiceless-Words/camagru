<?PHP

//setup connection for database

$DB_DNS = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = 'piet1234';

try{

    $connect = new PDO("mysql:host=$DB_DNS;", $DB_USER, $DB_PASSWORD);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e)
{

    echo $e->getMessage();
    die();

}