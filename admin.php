<?php 
	if ($_SESSION['user']['valid'] == 'true') {
		if (!isset($action)) { $action = 1; }
		print '
		<h1>Administration</h1>
		<div id="admin">';
			
			# Admin Users
			if ($action == 1 && $_SESSION['user']['username'] == 'admin') {
				include("users.php");
			}	
			else {
				echo '<p>To access this page, you need to be logged in as an admin! </p> <a href="index.php?menu=7">Click to go to Sign In!</a>';
			}
		
		print '
		</div>';
	}
?>
