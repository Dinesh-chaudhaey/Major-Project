<?php
ob_start();
session_start();
$user_ID= $_SESSION['user_ID'];
$currentUser = $_SESSION['adminName'];

if(!isset($user_ID))
{
	header("Location:index.php");
}

include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
?>

<div class="content-box"><!-- Start Content Box -->










</div>
<?php
include('includes/footer.php');
?>
<?php //ob_flush(); ?>