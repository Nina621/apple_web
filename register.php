<?php

require "dbconn.php";

print '
<h1>REGISTER</h1>
<div id="register">';

if ($_POST['_action_'] == FALSE) {
	print '
	<div class="con">
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">

				
				<div class="form-group">
				<div class="col">
						<label for="id">ID:</label>
				<input type="text" id="id" name="id" placeholder="Please put your idetification number:" required>
					</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="fname">First Name *</label>
						<input type="text" id="fname" name="firstname" placeholder="First name:" required>
					</div>
					<div class="col">
						<label for="lname">Last Name *</label>
						<input type="text" id="lname" name="lastname" placeholder="Last name:" required>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="email">E-mail *</label>
						<input type="email" id="email" name="email" placeholder="E-mail:" required>
					</div>
					<div class="col">
						<label for="password">Password:*</label>
						<input type="password" id="password" name="password" placeholder="Password:" pattern=".{4,}" required>
						<small>(Password must have min 4 char)</small>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="username">Username:*</label>
						<input type="text" id="username" name="username" pattern=".{5,10}" placeholder="Username:" required><br>
						<small>(Username must have min 5 and max 10 char)</small>
					</div>
					<div class="col">
						<label for="country">Country:</label>
						<select name="country" id="country">
							<option value="">Please choose:</option>';
	# Select all countries from database webprog, table countries
	$query = "SELECT * FROM countries";
	$result = @mysqli_query($MySQL, $query);
	while ($row = @mysqli_fetch_array($result)) {
		print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
	}
	print '
						</select>
					</div>
				</div>
			</div>

			<input type="submit" value="SUBMIT" class="submit-button">
		</form>
	</div>';
} else if ($_POST['_action_'] == TRUE) {
	$query = "SELECT * FROM users WHERE id='" . $_POST['id'] . "'";
	$result = mysqli_query($MySQL, $query);
	if (mysqli_num_rows($result) > 0) {
		echo 'User with this ID already exists!';
	} else {
		$query = "SELECT * FROM users";
		$query .= " WHERE email='" . $_POST['email'] . "'";
		$query .= " OR username='" . $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);

		if (empty($row['email']) || empty($row['username'])) {
			# password_hash https://secure.php.net/manual/en/function.password-hash.php
			# password_hash() creates a new password hash using a strong one-way hashing algorithm
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			$query = "INSERT INTO users (id,firstname, lastname, email, username, password, country)";
			$query .= " VALUES ('" . $_POST['id'] . "', '" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "')";
			$result = @mysqli_query($MySQL, $query);

			# ucfirst() — Make a string's first character uppercase
			# strtolower() - Make a string lowercase
			echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' . ucfirst(strtolower($_POST['lastname'])) . ', thank you for registration </p>
			<hr>';
		} else {
			echo '<p>User with this email or username already exists!</p>';
		}
	}
}
print '
	</div>';
?>