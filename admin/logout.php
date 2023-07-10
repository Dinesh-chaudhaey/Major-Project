<?php
session_start();

$user_ID= $_SESSION['user_ID'];
$currentUser = $_SESSION['adminName'];

unset($_SESSION['user_ID']);
unset($_SESSION['adminName']);

session_destroy();
header("location:index.php?msg=successfully+logged+out");
exit();
?>
