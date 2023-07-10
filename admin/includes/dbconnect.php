<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host="localhost";
$username="root";
$password="";
$db_name="mproject";

$db_connection = mysqli_connect($host, $username, $password);
if (!$db_connection) {
  error_log("Failed to connect to MySQL: " . mysqli_error($db_connection));
  die('Internal server error');
}

// 2. Select a database to use 
$db_select = mysqli_select_db($db_connection, $db_name);
if (!$db_select) {
  error_log("Database selection failed: " . mysqli_error($db_connection));
  die('Internal server error');
}
?>