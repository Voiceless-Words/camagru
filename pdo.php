<?PHP

try{
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
}*/
class UserEntry{
    public $user_name, $user_pass, $entry;   
    public function __construct(){
        $this->entry = "$this->user_name posted: $this->user_pass";
    }
}
echo "Connected to database\n";
/*fetching into a class*/
$query = $connect->query('SELECT * FROM user');
$query->setFetchMode(PDO::FETCH_CLASS, 'UserEntry');
while($rows = $query->fetch())
{
    echo '<pre>', $rows->entry, '</pre>';
}

?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           