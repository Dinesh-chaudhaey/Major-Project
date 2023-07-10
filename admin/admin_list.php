<?php 
ob_start();
session_start();
$user_ID= $_SESSION['user_ID'];
$currentUser = $_SESSION['adminName'];

if(!isset($user_ID) || $_SESSION['user_index']!='1'){
	header("Location:index.php");
}
$main_menu = "user-management";
$sub_menu = "list-user";

include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');
?>

<div class="content-box"><!-- Start Content Box -->
    <div style="font-size:15pt; text-align:center; display:block;"><strong>Total Users</strong></div>

    <table width='100%' border='0' cellpadding='0' cellspacing='0' class = 'table' align='center'>
    <tr>
        <td><b>SN</b></td>
        <td><b>Name</b></td>
        <td><b>Email</b></td>
        <td><b>User Type</b></td>
        <td><b>Last Login</b></td>
        <td><b>Last IP</b></td>
        <td><b>Status</b></td>
        <td><b>Edit/Delete</b></td>
    </tr>

<?php 
	$i=1;
	$limit = 10;
	$sql = "select * from admin order by user_ID DESC";
	include('pagination/paging.php');
	$result = $db_connection->query($sql);
	$rk  =  $result->num_rows;
	for($r=0; $r<$rk;$r++){
		while ($row = $result->fetch_array(MYSQLI_BOTH)){
		?>
		<tr><td><?php echo ($start+$i);?> </td>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['email'];?></td>
			<td>
				<?php 
					if($row['user_index']=='1') echo "Super Admin" ;
					else if($row['user_index']=='2') echo "Admin";
					else if($row['user_index']=='3') echo "Manager";
				?>
			</td>
			<td><?php echo $row['lastLogin'];?></td>
			<td><?php echo $row['LastIP'];?></td>
			<td>
			<a href="admin_change_user_status.php?status=<?php echo $row['status'];?>&id=<?php echo $row['user_ID']; ?>"><?php echo $row['status'] ?></a>
			</td>
		
			<td><a href='admin_edit_delete.php?action=edit&uid=<?php echo $row['user_ID']?>' title='click to edit this field'><img src="resources/images/icons/edit-icon.png" width="14" height="14" /></a> &nbsp;&nbsp;<a href='admin_edit_delete.php?action=del&uid=<?php echo $row['user_ID']?>' title='click to delete this field' onclick ="return confirm('Are u sure?')"><img src="resources/images/icons/cross.png"/></a></td>
		</tr>
	  <?php $i++; 
		}
	}
?>
</table>
<?php include_once('pagination/paging_show.php'); ?>
 
 
</div>
<?php
	include('includes/footer.php');
	ob_flush();
?>