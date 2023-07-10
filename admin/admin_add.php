<?php
ob_start();
session_start();
$user_ID= $_SESSION['user_ID'];
$currentUser = $_SESSION['adminName'];

if(!isset($user_ID) || $_SESSION['user_index']!='1'){
	header("Location:index.php");
}
$main_menu = "user-management";
$sub_menu = "add-user";

include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');
?>

<?php 
	if (isset($_POST['submit'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$user_index=$_POST['user_index'];
		$username=$_POST['user'];
		$password=$_POST['password'];
		//$password=md5($password);
		
		$sql = "select * from admin where username='$username' OR email='$email' ";
		$result = $db_connection->query($sql);
		if( $result->num_rows == 0){
			$sql = "INSERT INTO admin set name='{$name}', email='{$email}', user_index='{$user_index}', username='{$username}', password='{$password}'";
			$result = $db_connection->query($sql);
			if($result){
				header('Location:admin_list.php?msg='.urlencode('New User Added Successfully'));	
			}else{
				header('Location:admin_add.php?msg='.urlencode('Sorry! User cannot be created. please try again'));	
			}
		}else{
			header('Location:admin_add.php?msg='.urlencode('The username or email you entered already exists . Please try a new one'));
		}
	}
?>

<script language="javascript">
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}	
</script>

<div class="content-box"><!-- Start Content Box -->
<form method="post" action="admin_add.php">
<table width="600" border="0" align="center">
        
        <tr>
        	<td colspan="2" align="center"><strong>Add Admin</strong></td>
        </tr>
        
        <tr>
            <td>Name</td>
            <td><input type="text" class="text-input medium-input" name="name" required value=""></td>
        </tr>
         
        <tr>
            <td>Email</td>
            <td><input type="email" class="text-input medium-input" name="email" value="" required></td>
        </tr>
          
        <tr>
            <td>Admin Type</td>
            <td><select name="user_index">
            	<option value="0">...Select User Type...</option>
            	<option value="1">Super Admin</option>
                <option value="2">Admin</option>
            	<option value="3">Manager</option>
            	</select>
          	</td>
        </tr>

        <tr>
            <td>username</td>
            <td><input type="text" class="text-input medium-input" name="user" value="" required></td>
        </tr>
     
        <tr>
            <td>Password</td>
            <td><input type="password" class="text-input medium-input" name="password" required></td>
        </tr>
        
        <tr>
        	<td></td>
            <td><input type="submit" name="submit" value="ADD" class="button"></td>
        </tr>
        
    </table>
    </form>
</table>
 
</div>
<?php
	include('includes/footer.php');
	ob_flush();
?>
