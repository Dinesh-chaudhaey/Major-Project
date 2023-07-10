<?php 
ob_start();
session_start();

$user_ID= $_SESSION['user_ID'];
$currentUser = $_SESSION['adminName'];

include('includes/dbconnect.php');
if(!isset($user_ID) || $_SESSION['user_index']!='1'){
	header("Location:login.php");
}

$id = $_GET['id'];
$status = $_GET['status'];
if ($_SESSION['user_ID']==$_GET['id']){
	header("Location:admin_list.php?msg=You cannot change your own status");
}else{
	if($status == '0'){
		$st = "1";
	}else{
		$st = "0";
	}
	$sql = "update  admin set status='$st' where user_ID = '$id'";
	$result = $db_connection->query($sql);

	if($result){
		header('Location:admin_list.php?msg=User status Updated Successfully');	
	}else{
		header('Location:admin_list.php?msg=Sorry! User status cannot be changed. please try again');		
	}
}

ob_flush();
?> 
 