<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Your Page Title Goes Here</title>
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />	
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.datePicker.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.date.js"></script>
</head>
	<body>
    	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
			<div id="sidebar"><!-- start #sidebar -->
				<div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
					<h1 id="sidebar-title"><a href="">Website Admin</a></h1>
		  
					<!-- Logo (221px wide) -->
					<a href="dashboard.php"><img id="logo" src="resources/images/logo.jpg" alt="logo" /></a>
		  
					<!-- Sidebar Profile links -->
					<div id="profile-links">
						Hello  <?php echo $_SESSION['adminName'];?> <br /><br>
						<a href="admin_change_password.php" title="Change Password">Change Password</a>
						<br><br>
						<a href="#" title="View Website">View the Site</a> || 
						<a href="logout.php" title="Sign Out">Sign Out</a>
					</div>        
			
					<ul id="main-nav">  <!-- Accordion Menu -->
						<li>
							<a href="dashboard.php" class="nav-top-item no-submenu"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
								Dashboard
							</a>       
						</li>
						<?php if($_SESSION['user_index']=='1'){ ?>
						<li>
							<a href="javascript:void(0);" class="nav-top-item <?php if(isset($sub_menu) && $main_menu=='user-management'){echo 'current';} ?>">User Management</a>
							<ul>
								<li><a href="admin_list.php" <?php if(isset($sub_menu) && $sub_menu=='list-user'){echo 'class="current"';} ?>>List Users</a></li>
								<li><a href="admin_add.php" <?php if(isset($sub_menu) && $sub_menu=='add-user'){echo 'class="current"';} ?>>Add Users</a></li>
								<!-- <li><a href="admin_edit_delete.php">Edit / Delete Users</a></li> -->
							</ul>
						</li> 
						
						
						<li>
							<a href="javascript:void(0);" class="nav-top-item <?php if(isset($sub_menu) && $main_menu=='user-management'){echo 'current';} ?>">Food Management</a>
							<ul>
								<li><a href="list_food.php" <?php if(isset($sub_menu) && $sub_menu=='list-food'){echo 'class="current"';} ?>>List Food</a></li>
								<li><a href="add_food.php" <?php if(isset($sub_menu) && $sub_menu=='add-food'){echo 'class="current"';} ?>>Add Food</a></li>
								<!-- <li><a href="admin_edit_delete.php">Edit / Delete Users</a></li> -->
							</ul>
						</li> 

						<li>
							<a href="javascript:void(0);" class="nav-top-item <?php if(isset($sub_menu) && $main_menu=='user-management'){echo 'current';} ?>">Category Management</a>
							<ul>
								<li><a href="list_service.php" <?php if(isset($sub_menu) && $sub_menu=='list-service'){echo 'class="current"';} ?>>List Category</a></li>
								<li><a href="add_service.php" <?php if(isset($sub_menu) && $sub_menu=='add-service'){echo 'class="current"';} ?>>Add Category</a></li>
								<!-- <li><a href="admin_edit_delete.php">Edit / Delete Users</a></li> -->
							</ul>
						</li>
						
						<li>
							<a href="javascript:void(0);" class="nav-top-item <?php if(isset($sub_menu) && $main_menu=='consumer-management'){echo 'current';} ?>">Consumer Management</a>
							<ul>
								<li><a href="list_consumer.php" <?php if(isset($sub_menu) && $sub_menu=='list-consumer'){echo 'class="current"';} ?>>List Consumer</a></li>
								
								<!-- <li><a href="admin_edit_delete.php">Edit / Delete Users</a></li> -->
							</ul>
						</li> 


						<li>
							<a href="list_order.php" class="nav-top-item no-submenu">Order Management</a>
						</li>    
						<?php 
						}
						?>
						<!--<li>
							<a href="#" class="nav-top-item">Palette</a>
							<ul>
								<li><a href="addImage.php">Upload Palette</a></li>
								<li><a href="edit_delete_palette.php">View / Edit / Delete Palette</a></li>
							</ul>
						</li>-->
						
						<!--<li>
							<a href="#" class="nav-top-item">Email</a>
							<ul>
								<li><a href="changeEmail.php">Change Email</a></li>
							</ul>
						</li>-->
						
						<!-- <li>
							<a href="#" class="nav-top-item">Ribbon</a>
							<ul>
								<li><a href="ribbon_details.php">View Ribbons details</a></li>
							</ul>
						</li>-->

						<li>
							<a href="logout.php" class="nav-top-item no-submenu current"> Logout </a> 
						</li>
				
					</ul> <!-- End #main-nav -->	
				
				</div>	
			</div> <!-- Ends sidebar here-->
        </div> <!--Ends body-wrapper-->
        
        <div id="main-content"> <!-- Main Content Section with everything -->
