<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id6742935_root');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'id6742935_conference_app');
// Attempt to connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
