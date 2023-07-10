<?php

ob_start();
session_start();



include('includes/dbconnect.php');
include('includes/left_sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');
?>

<?php
if(isset($_POST['submit'])){
	$food=$_POST['food'];
	$price=$_POST['price'];
	$quantity=$_POST['qty'];
	$total=$price * $quantity; 
	$order_date=date("y-m-d h:i:sa");
	$status="Ordered";
	$customer_name=$_POST['full_name'];
	$contact=$_POST['contact'];
	$email=$_POST['email'];
	$address=$_POST['address'];

	$sql1="INSERT INTO tbl_order set
	food='{$food}',
	price='{$price}',
	quantity='{$quantity}',
	total='{$total}',
	order_date='{$order_date}',
	status='{$status}',
	customer_name='{$customer_name}',
	contact='{$contact}',
	email='{$email}',
	address='{$address}'
	
	";

	$result1=mysqli_query($db_connection, $sql1);
	if($result1==true){
		header('Location:home.php?msg='.urldecode('Food Ordered Successfully'));
	}else{
		header('Location:home.php?msg='.urlencode('Failed to order Food'));
	}
}



?>




<?php
include('includes/footer.php');
ob_flush();
?>