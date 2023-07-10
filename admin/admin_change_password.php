<?php
ob_start();
session_start();

$user_ID= $_SESSION['user_ID'];
$currentUser = $_SESSION['adminName'];

 if(!isset($user_ID)){
	header("Location:index.php?msg=You are not authorized");
}
include('includes/dbconnect.php');
include('includes/left_Sidebar.php');
include('includes/shortcutButtons.php');
include('includes/notifications.php');

?>
<div class="content-box"><!-- Start Content Box -->

</table>
<?php

	if(isset($_POST['submit'])){
		$op=$_POST['password'];
		$np=$_POST['npassword'];
		$rnp=$_POST['rnpassword'];
		$sql="select * from admin where user_ID='$user_ID'";
		$rk = $db_connection->query($sql);
		if(!$rk){
			header("Location:admin_change_password.php?msg=".urlencode("No Data Found"));
		}
		//$rk=mysql_query($sql) or die("sorry error in the execution");
		//while($row=mysql_fetch_array($rk))

		$row = $rk->fetch_array(MYSQLI_BOTH);

		$old=$row['password'];
		if(!empty($op)){
			if(!empty($np)){
				if(!empty($rnp)){
					if($op==$old){
						if($np==$rnp){	
							if(strlen($np)>=5){
								$sql = "update admin set password='$np' where user_ID='$user_ID'";
								$qry = $db_connection->query($sql);
								if($qry){
									header("Location:admin_change_password.php?msg=".urlencode("Passowrd Updated successfully. Remember Your new password is<b> ".$np));
								}else{
									header("Location:admin_change_password.php?msg=Error: ".urlencode($db_connection->error));
								}
							}else{
								header("Location:admin_change_password.php?msg=".urlencode("Password should have at least 5 characters"));
							}
						}else{
							header("Location:admin_change_password.php?msg=".urlencode("Two passwords donot match try again"));
						}
					}else{
						header("Location:admin_change_password.php?msg=".urlencode("Error:Sorry! wrong old password"));
					}
				}else{
					header("Location:admin_change_password.php?msg=".urlencode("Please reenter the password"));
				}
			}else{
				header("Location:admin_change_password.php?msg=".urlencode("Error:Please enter the password"));
			}
		}else{
			header("Location:admin_change_password.php?msg=".urlencode("Error:Please enter the old password"));
		}
	}
?>

<br>
<form method='post' action=''>
<table border='0' width='90%' cellpadding='0' cellspacing='0' class='table' >
<tr><td colspan='2' align='center'><b>Change Password</b></td></tr>
<tr><th>Old Password</td><td><input type='password' class="text-input medium-input" name='password' size='50' required="required"></th></tr>
<tr><th>New Password</td><td><input type='password' class="text-input medium-input" name='npassword' size='50' required="required"></th></tr>
<tr><th>Re-New Password</td><td><input type='password' class="text-input medium-input" name='rnpassword' size='50' required="required"></th></tr>
<tr><td></td><td><input type='submit' name='submit' value='Submit' class="button"></td></tr>
</table>
</form>

</div>
<?php
include('includes/footer.php');
ob_flush();
?>