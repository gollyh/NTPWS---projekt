<?php 
	print '
	<ul>
		<li><a href="index.php?menu=3">Contact</a></li>
		<li><a href="index.php?menu=1">History</a></li>
		<li><a href="index.php?menu=5">Meals</a></li>';
		if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
			print '
			<li><a href="index.php?menu=6">Register</a></li>
			<li><a href="index.php?menu=7">Sign In</a></li>';
		}
		
		else if ($_SESSION['user']['valid'] == 'true') {
			print '
			<li><a href="index.php?menu=2">Recipes</a></li>
			<li><a href="index.php?menu=4">Restorants</a></li>
			<li><a href="signout.php">Sign Out</a></li>
			<li><a href="index.php?menu=8">Admin</a></li>';
		}
		print '
	</ul>';
?>