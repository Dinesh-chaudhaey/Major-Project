<?php
ob_start();
session_start();
$user_ID= $_SESSION['user_ID'];
$currentUser = $_SESSION['adminName'];

if(!isset($user_ID)) {
	header("Location:index.php");
}


include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');
?>

<?php

?>

<div class="content-box"><!-- Start Content Box -->
<div style="font-size:15pt; text-align:center; display:block;"><strong>Total Order</strong></div>
<table width='100%' border='0' cellpadding='0' cellspacing='0' class='table' align='center'>

<tr>
	<td><b>S.N</b></td>
	<td><b>Food</b></td>
	<td><b>Price</b></td>
	<td><b>Qty</b></td>
	<td><b>Total</b></td>
	<td><b>Order Date</b></td>
	<td><b>Status</b></td>
	<td><b>Customer Name</b></td>
	<td><b>Contact</b></td>
	<td><b>Email</b></td>
	<td><b>Address</b></td>
	<td><b>Edit/Delete</b></td>

</tr>

<?php
$i=1;
$limit=50;

$sql="select * from tbl_order order by id DESC";
include('pagination/paging.php');
$result=$db_connection->query($sql);
$rk=$result->num_rows;
for($r=0; $r<$rk; $r++){
	while($row= $result->fetch_array(MYSQLI_BOTH)){
		$id=$row['id'];
		$food=$row['food'];
		$price=$row['price'];
		$qty=$row['quantity'];
		$total=$row['total'];
		$order_date=$row['order_date'];
		$status=$row['status'];
		$customer_name=$row['customer_name'];
		$contact=$row['contact'];
		$email=$row['email'];
		$address=$row['address'];

		?>
		<tr>
		    <td><?php echo ($start+$i);?></td>
			<td><?php echo $row['food'];?></td>
			<td><?php echo $row['price'];?></td>
			<td><?php echo $row['quantity'];?></td>
			<td><?php echo $row['total'];?></td>
			<td><?php echo $row['order_date'];?></td>
			<td><?php echo $row['status'];?></td>
			<td><?php echo $row['customer_name'];?></td>
			<td><?php echo $row['contact'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php echo $row['address'];?></td>

			<td><a href='order_edit_delete.php?action=edit&id=<?php echo $row['id']?>' title='click to edit this field'><img src="resources/images/icons/edit-icon.png" width="14" height="14"></a> &nbsp;&nbsp;<a href='order_edit_delete.php?action=del&id=<?php echo $row['id']?>' title='click to delete this field' onclick="return confirm('Are you sure want to delete this field')"><img src="resources/images/icons/cross.png" alt=""></a></td>
			
		</tr>

		<?php $i++;

	}
}

?>

</table>

<?php include_once('pagination/paging_show.php');?>

</div>
<?php
include('includes/footer.php');
ob_flush();
?>
<?php //ob_flush(); ?>
