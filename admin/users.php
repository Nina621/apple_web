<?php

# Update user profile
if (isset($_POST['edit']) && $_POST['_action_'] == 'TRUE') {
	$query = "UPDATE users SET firstname='" . $_POST['firstname'] . "', lastname='" . $_POST['lastname'] . "', email='" . $_POST['email'] . "', username='" . $_POST['username'] . "', country='" . $_POST['country'] . "', archive='" . $_POST['archive'] . "', role='" . $_POST['role'] . "'";
	$query .= " WHERE id=" . (int) $_POST['edit'];
	$query .= " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);
	# Close MySQL connection
	@mysqli_close($MySQL);

	$_SESSION['message'] = '<p>You successfully changed user profile!</p>';

	# Redirect
	header("Location: index.php?menu=7&action=1");
}
# End update user profile

# Delete user profile
if (isset($_GET['delete']) && $_GET['delete'] != '') {

	$query = "DELETE FROM users";
	$query .= " WHERE id=" . (int) $_GET['delete'];
	$query .= " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);

	$_SESSION['message'] = '<p>You successfully deleted user profile!</p>';

	# Redirect
	header("Location: index.php?menu=7&action=1");
}
# End delete user profile

#Show user info
if (isset($_GET['id']) && $_GET['id'] != '') {
	$query = "SELECT * FROM users";
	$query .= " WHERE id=" . $_GET['id'];
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	print '
		<h2>USER PROFILE</h2>
		<div class="profile-container">
			<div class="profile-info">
				<p><b>First name:</b> ' . $row['firstname'] . '</p>
				<p><b>Last name:</b> ' . $row['lastname'] . '</p>
				<p><b>Username:</b> ' . $row['username'] . '</p>';
	if ($row['role'] == 1) {
		print '<p><b>Role:</b> ' . "Administrator" . '</p>';
	} else if ($row['role'] == 2) {
		print '<p><b>Role:</b> ' . "Editor" . '</p>';
	} else {
		print '<p><b>Role:</b> ' . "User" . '</p>';
	}
	$_query = "SELECT * FROM countries";
	$_query .= " WHERE country_code='" . $row['country'] . "'";
	$_result = @mysqli_query($MySQL, $_query);
	$_row = @mysqli_fetch_array($_result);
	print '
				<p><b>Country:</b> ' . $_row['country_name'] . '</p>
				<p><b>Date:</b> ' . pickerDateToMysql($row['date']) . '</p>
				<p><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '"> &larr;  Back</a></p>
			</div>
		</div>';
}

#Edit user profile
else if (isset($_GET['edit']) && $_GET['edit'] != '') {
	if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2) {
		$query = "SELECT * FROM users";
		$query .= " WHERE id=" . $_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_archive = false;

		print '
			<h2>EDIT USER PROFILE</h2>
			<div class="edit-profile-container">
	<form class="forma" action="" id="registration_form" name="registration_form" method="POST">
		<input type="hidden" id="_action_" name="_action_" value="TRUE">
		<input type="hidden" id="edit" name="edit" value="' . $_GET['edit'] . '">

		<div class="form-group">
		<div class="row">
		  <div class="col">
		  <label for="fname">First Name *</label>
		  <input type="text" id="fname" name="firstname" value="' . $row['firstname'] . '" placeholder="Your name" required>
		  </div>
		  <div class="col">
		  <label for="lname">Last Name *</label>
		  <input type="text" id="lname" name="lastname" value="' . $row['lastname'] . '" placeholder="Your last natme" required>
		  </div>
		</div>
	  </div>	
	  <div class="form-group">
	  <div class="row">
		<div class="col">
		<label for="email">Your E-mail *</label>
		<input type="email" id="email" name="email"  value="' . $row['email'] . '" placeholder="Your e-mail" required>
		</div>
		 <div class="col">
	  <label for="role">Role</label>
		<input type="number" id="role" name="role"  value="' . $row['role'] . '" placeholder="Role" required>
<small>(Please choose a number from 1-3)</small>	  
</div
	  </div>
	</div>	
	<div class="form-group">
	<div class="row">
	  <div class="col">
	  <label for="username">Username *</label>
				<input type="text" id="username" name="username" value="' . $row['username'] . '" pattern=".{5,10}" placeholder="Username.." required><br>
				<small>(Username must have min 5 and max 10 char)</small>
	  </div>
	  <div class="col">
	  	<label for="country">Country</label>
				<select name="country" id="country">
					<option value="">Country</option>';
		#Select all countries from database webprog, table countries
		$_query = "SELECT * FROM countries";
		$_result = @mysqli_query($MySQL, $_query);
		while ($_row = @mysqli_fetch_array($_result)) {
			print '<option value="' . $_row['country_code'] . '"';
			if ($row['country'] == $_row['country_code']) {
				print ' selected';
			}
			print '>' . $_row['country_name'] . '</option>';
		}
		print '
	</select>
	  </div>
	</div>
  </div>
  	<div class="form-group">
		<div class="row">
		  <div class="col">
			<label for="archive">Archive:</label><br />
				<input type="radio" name="archive" value="Y"';
		if ($row['archive'] == 'Y') {
			echo ' checked="checked"';
			$checked_archive = true;
		}
		echo ' /> YES &nbsp;&nbsp;
				<input type="radio" name="archive" value="N"';
		if ($checked_archive == false) {
			echo ' checked="checked"';
		}
		echo ' /> NO
		  </div>
	  </div>
		<input type="submit" value="Submit">
	</form>
</div>
	</form>';
	} else {
		print '<p>Forbidden</p>';
	}
} else {
	print '
	<h2>LIST OF USERS</h2>
	<div id="users">
		<table>
			<tr>
				<th width="16"></th>
				<th width="16"></th>
				<th width="16"></th>
				<th>NAME</th>
				<th>SURNAME</th>
				<th>MAIL</th>
				<th>COUNTRY</th>
				<th width="16"></th>
			</tr>';
	$query = "SELECT * FROM users";
	$result = @mysqli_query($MySQL, $query);
	while ($row = @mysqli_fetch_array($result)) {
		print '
			<tr>
				<td><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;id=' . $row['id'] . '"><img src="imgs/user.png" alt="user"></a></td>
				<td>';
		if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2) {
			print '<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;edit=' . $row['id'] . '"><img src="imgs/edit.png" alt="uredi"></a></td>';
		}
		print '
				<td>';
		if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2) {
			print '<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;delete=' . $row['id'] . '"><img src="imgs/delete.png" alt="obriši"></a>';
		}
		print '	
				</td>
				<td><strong>' . $row['firstname'] . '</strong></td>
				<td><strong>' . $row['lastname'] . '</strong></td>
				<td class="email">' . $row['email'] . '</td>
				<td class="country">' . $row['country'] . '</td>
				<td>';
		if ($row['archive'] == 'Y') {
			print '<img src="imgs/inactive.png" alt="" title="" />';
		} else if ($row['archive'] == 'N') {
			print '<img src="imgs/active.png" alt="" title="" />';
		}
		print '
				</td>
			</tr>';
	}
	print '
		</table>
	</div>';

}

# Close MySQL connection
@mysqli_close($MySQL);
?>