<?php 
/*
define("DB_SERVER", "localhost");
define("DB_USER", "id3913421_ouafae");
define("DB_PASSWORD", "abcd1234");
define("DB_DATABASE", "id3913421_oehaddouchi");

$conn = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/
    $db = new PDO('mysql:host=localhost;dbname=id3913421_oehaddouchi', 'id3913421_ouafae', 'abcd1234');
    

?>