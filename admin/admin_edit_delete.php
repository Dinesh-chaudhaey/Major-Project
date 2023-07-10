<?php 
ob_start();
session_start();
$user_ID= $_SESSION['user_ID'];
$currentUser = $_SESSION['adminName'];

if(!isset($user_ID) || $_SESSION['user_index']!='1'){
	header("Location:index.php");
}
include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');
?>

<div class="content-box"><!-- Start Content Box -->

<?php 
	if ((isset($_GET['uid'])) && $_GET['action']=='edit'){
		$sql = "SELECT * FROM admin where user_ID=".$_GET['uid'];
		//echo $sql;
		$result = $db_connection->query($sql);
		$groupResult = $result->fetch_array(MYSQLI_BOTH);
	//}
?>
<form method="post" action="">
	<table width="100%" border="0" align="center">
		<input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
		<tr>
			<td colspan="2" align="center"><strong>Edit User</strong></td>
		</tr>
		
		<tr>
			<td>Name</td>
			<td><input type="text" class="text-input medium-input" name="name" required value="<?php echo $groupResult['name'];?>"></td>
		</tr>
		 
		<tr>
			<td>Email</td>
			<td><input type="email" class="text-input medium-input" name="email" value="<?php echo $groupResult['email'];?>" required></td>
		</tr>
		  
		<tr>
            <td>Admin Type</td>
            <td><select name="user_index">
            	<option value="0">...Select User Type...</option>
            	<option value="1" <?php if($groupResult['user_index']=='1') echo "selected='selected'"; ?>>Super Admin</option>
                <option value="2" <?php if($groupResult['user_index']=='2') echo "selected='selected'"; ?>>Admin</option>
            	<option value="3" <?php if($groupResult['user_index']=='3') echo "selected='selected'"; ?>>Manager</option>
            	</select>
          	</td>
        </tr>
		
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="UPDATE" class="button"></td>
		</tr>
		
	</table>
</form>
<?php } //End of form section  ?>

    <?php
	if (isset($_POST['submit'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$user_index=$_POST['user_index'];

		//echo "<pre>"; print_r($_GET);
		//echo "<pre>"; print_r($_POST);

		$sql = "UPDATE admin set name='$name', email='$email', user_index='$user_index' where user_ID=".$_GET['uid'];
		//echo $sql; exit;
		$result = $db_connection->query($sql);
		if($result){
			header('Location:admin_list.php?msg='.urlencode('User Updated Successfully'));
		}else{
			header('Location:admin_list.php?msg='.urlencode('Sorry! User cannot be edited. please try again'));		
		}
	}
?>

<?php
if ((isset($_GET['uid'])) && $_GET['action']=='del'){
		$id  = $_GET['uid'];
		if($id != $user_ID){
			$sql = "delete from admin where user_ID = ".$id." AND user_ID !=".$user_ID;
			$result = $db_connection->query($sql);
			if($result){
				header("Location:admin_list.php?msg=".urlencode('User deleted successfully'));
				exit();
			}
		}else{
			header("Location:admin_list.php?msg=".urlencode("You Cannot delete yourself"));
			exit();
		}
		
	}
?>

</div>
<?php
	include('includes/footer.php');
	ob_flush();
?>