<?php
	ob_start();
	session_start();
	include('includes/dbconnect.php');
	include('includes/functions.php'); 
	if(isset($_POST['submit']) && $_POST['submit'] != ''){
		$user = cleanQuery($_POST['username']);
    	$pass = cleanQuery($_POST['password']);
		//$pass=md5(cleanQuery($_POST['password']));
		
		if(isset($user) && $user != '' && isset($pass) && $pass !=''){
			//now make query in the database to check username and password
			$sql = "Select * from admin where username='$user' and password='$pass'";
			//echo $sql; exit;
			$result = $db_connection->query($sql);

			//echo $result->num_rows; exit;
			
			if( $result->num_rows == 1){
				// user is verified
				$row_data = $result->fetch_array(MYSQLI_ASSOC);
				//echo "<pre>"; print_r($row_data); echo "</pre>"; exit;

				if($row_data['status'] == 1){
					
					$id=$row_data['user_ID'];
				
					$_SESSION['user_ID']=$row_data['user_ID'];

					$_SESSION['adminName']=$row_data['name'];
					
					$_SESSION['user_index']=$row_data['user_index'];
					
					$_SESSION['last_login']=$row_data['lastLogin'];
					// it assigns last login time fetched from database to a session variable.
					
					$_SESSION['lastIP']=$row_data['LastIP']; 
					// it assigns last ip fetched from database to a session variable.

					$client=$_SERVER['REMOTE_ADDR'];
					$update_sql = "UPDATE admin SET LastIP='$client',lastLogin=NOW() where user_ID='$id'";
					$update_query = $db_connection->query($update_sql);
					//head to index page after update
					header("location:dashboard.php");

				}else{

				}	
			}else{
				header("location:index.php?msg=Wrong Username Password. Please Try Again");
			}
		}else{
			header("location:index.php?msg=Please Enter Username and Password");
			//header("location:index.php?msg=Please Fill up the form and click submit button");
		}
	}else{
		
	}
		
?>	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Admin | Sign In</title>
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />	
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
</head>
 
	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>Pin People</h1>
				<!-- Logo (221px width) -->
				<a href="index.php"><img id="logo" src="resources/images/logo.jpg" alt="Harekpal Admin logo" /></a>
			</div> <!-- End #logn-top -->

			<div id="login-content">
				<form action="" method="post">
					<div class="notification information png_bg">
						<div> 
							<?php
								if(isset ($_REQUEST['msg'])){
									$msg=$_REQUEST['msg'];
									echo $msg;
								}else{
									echo"Please Enter username and password";	
								}
								
							?>
						</div>
					</div>
					
					<p>
						<label>Username</label>
						<input class="text-input" type="text" name="username"/>
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" type="password" name="password"/>
					</p>
					<div class="clear"></div>
					<!--<p id="remember-password">
						<input type="checkbox" />Remember me
					</p>-->
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" value="Sign In" name="submit"/>
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
  </body>
<?php ob_flush();  ?>
</html>