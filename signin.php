<?php

print '
	<h1>SIGNI IN</h1>
	<div id="signin">';

if ($_POST['_action_'] == FALSE) {
	print '
		<div class="container">
  <form action="" name="myForm" id="myForm" method="POST">
    <input type="hidden" id="_action_" name="_action_" value="TRUE">

    <div class="form-group">
      <label for="username">Username:</label>
	  <input type="text" id="username" name="username" placeholder="Username:" value="" pattern=".{5,10}" required>
    </div>
									
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Password:" value="" pattern=".{4,}" required>
    </div>						
    <input type="submit" value="SUBMIT" class="submit-button">
  </form>
</div>';
} else if ($_POST['_action_'] == TRUE) {

	$query = "SELECT * FROM users";
	$query .= " WHERE username='" . $_POST['username'] . "'  AND archive='N'";
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
	if (password_verify($_POST['password'], $row['password'])) {
		#password_verify https://secure.php.net/manual/en/function.password-verify.php
		$_SESSION['user']['valid'] = 'true';
		$_SESSION['user']['id'] = $row['id'];
		# 1 - administrator; 2 - editor; 3 - user
		$_SESSION['user']['role'] = $row['role'];
		$_SESSION['user']['firstname'] = $row['firstname'];
		$_SESSION['user']['lastname'] = $row['lastname'];
		$_SESSION['message'] = '<p>Welcome, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
		# Redirect to admin website
		header("Location: index.php?menu=1");
	}

	# Bad username or password
	else {
		unset($_SESSION['user']);
		$_SESSION['message'] = '<p>You entered wrong email or password!</p>';
		header("Location: index.php?menu=6");
	}
}
print '
	</div>';
?>