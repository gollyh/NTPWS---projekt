<?php 
	print '
	<h1>Sign In form</h1>
	<h2>In order to get more restaurants and recipes, please Sign In!</h2>
	<div id="signin">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">

			<label for="username">Username:*</label>
			<input type="text" id="username" name="username" value="" pattern=".{5,10}" required>
									
			<label for="password">Password:*</label>
			<input type="password" id="password" name="password" value="" pattern=".{4,}" required>
									
			<input type="submit" value="Submit">
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$query .= " AND archive='Y'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		// After successful login
		// After successful login
if (password_verify($_POST['password'], $row['password'])) {
    // Set additional user information in the session
    $_SESSION['user']['valid'] = 'true';
    $_SESSION['user']['id'] = $row['id'];
    $_SESSION['user']['username'] = $row['username']; // Add this line
    $_SESSION['user']['firstname'] = $row['firstname'];
    $_SESSION['user']['lastname'] = $row['lastname'];
    $_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
    // Debugging statements
    echo 'Username set in session: ' . $_SESSION['user']['username'];
    // Redirect to admin website
    header("Location: index.php?menu=1");
} else {
    // Bad username or password
    unset($_SESSION['user']);
    $_SESSION['message'] = '<p>You entered wrong email or password!</p>';
    header("Location: index.php?menu=6");
}

	}
	print '
	</div>';
?>