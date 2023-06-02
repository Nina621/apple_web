<?php
#Add news
if (isset($_POST['_action_']) && $_POST['_action_'] == 'add_news') {
	$_SESSION['message'] = '';
	# htmlspecialchars — Convert special characters to HTML entities
	# http://php.net/manual/en/function.htmlspecialchars.php
	$query = "INSERT INTO news (title, description, archive)";
	$query .= " VALUES ('" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', '" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', '" . $_POST['archive'] . "')";
	$result = @mysqli_query($MySQL, $query);

	$ID = mysqli_insert_id($MySQL);

	# picture
	if ($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {

		# strtolower - Returns string with all alphabetic characters converted to lowercase. 
		# strrchr - Find the last occurrence of a character in a string
		$ext = strtolower(strrchr($_FILES['picture']['name'], "."));

		$_picture = $ID . '-' . rand(1, 100) . $ext;
		copy($_FILES['picture']['tmp_name'], "news/" . $_picture);

		if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { # test if format is picture
			$_query = "UPDATE news SET picture='" . $_picture . "'";
			$_query .= " WHERE id=" . $ID . " LIMIT 1";
			$_result = @mysqli_query($MySQL, $_query);
			$_SESSION['message'] .= '<p>You successfully added picture.</p>';
		}
	}


	$_SESSION['message'] .= '<p>You successfully added news!</p>';

	# Redirect
	header("Location: index.php?menu=7&action=2");
}

# Update news
if (isset($_POST['_action_']) && $_POST['_action_'] == 'edit_news') {
	$query = "UPDATE news SET title='" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', description='" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', archive='" . $_POST['archive'] . "'";
	$query .= " WHERE id=" . (int) $_POST['edit'];
	$query .= " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);

	# picture
	if ($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {

		# strtolower - Returns string with all alphabetic characters converted to lowercase. 
		# strrchr - Find the last occurrence of a character in a string
		$ext = strtolower(strrchr($_FILES['picture']['name'], "."));

		$_picture = (int) $_POST['edit'] . '-' . rand(1, 100) . $ext;
		copy($_FILES['picture']['tmp_name'], "news/" . $_picture);


		if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { # test if format is picture
			$_query = "UPDATE news SET picture='" . $_picture . "'";
			$_query .= " WHERE id=" . (int) $_POST['edit'] . " LIMIT 1";
			$_result = @mysqli_query($MySQL, $_query);
			$_SESSION['message'] .= '<p>You successfully added picture.</p>';
		}
	}

	$_SESSION['message'] = '<p>You successfully changed news!</p>';

	# Redirect
	header("Location: index.php?menu=7&action=2");
}
# End update news

# Delete news
if (isset($_GET['delete']) && $_GET['delete'] != '') {

	# Delete picture
	$query = "SELECT picture FROM news";
	$query .= " WHERE id=" . (int) $_GET['delete'] . " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	@unlink("news/" . $row['picture']);

	# Delete news
	$query = "DELETE FROM news";
	$query .= " WHERE id=" . (int) $_GET['delete'];
	$query .= " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);

	$_SESSION['message'] = '<p>You successfully deleted news!</p>';

	# Redirect
	header("Location: index.php?menu=7&action=2");
}
# End delete news


#Show news info
if (isset($_GET['id']) && $_GET['id'] != '') {
	$query = "SELECT * FROM news";
	$query .= " WHERE id=" . $_GET['id'];
	$query .= " ORDER BY date DESC";
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	print '
		<h2>NEWS OVERVIEW</h2>
		<div class="news">
		<div style="margin-top: 20px;"></div>
			<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '" style="height: 200px;">
			<h2>' . $row['title'] . '</h2>
			' . $row['description'] . '
			<hr>
		</div>
		<p><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '"> &larr; Back</a></p>';
}

#Add news 
else if (isset($_GET['add']) && $_GET['add'] != '') {

	print '
		<h3>ADD NEWS</h3>
			<div class="edit-news-container">
				<form action="" id="news_form" name="news_form" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="add_news">

			<div class="form-group">
		<div class="row">
		  <div class="col">
			<label for="title">Title *</label>
			<input type="text" id="title" name="title" placeholder="News title.." required>
		  </div>
		  <div class="col">
		<label for="archive">Archive:</label><br />
            <input type="radio" name="archive" value="Y"> YES &nbsp;&nbsp;
			<input type="radio" name="archive" value="N" checked> NO
		  </div>
		</div>
	  </div>
	  	<div class="form-group">
		<div class="row">
		  <div class="col">
			<label for="description">Description *</label>
			<textarea id="description" name="description" style="width: 500px; height: 80px;" placeholder="News description:" required></textarea>
		  </div>
		</div>
<label for="picture">Picture:</label>
			<input type="file" id="picture" name="picture">
	  </div>
			<input type="submit" value="Submit">
		</form>
			</div>';
}
#Edit news
else if (isset($_GET['edit']) && $_GET['edit'] != '') {
	$query = "SELECT * FROM news";
	$query .= " WHERE id=" . $_GET['edit'];
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	$checked_archive = false;

	print '
		<h3>EDIT NEWS</h3>
		<div class="edit-news-container">
		<form action="" id="news_form_edit" name="news_form_edit" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="edit_news">
			<input type="hidden" id="edit" name="edit" value="' . $row['id'] . '">
			<div class="form-group">
		<div class="row">
		  <div class="col">
		  		<label for="title">Title *</label>
			<input type="text" id="title" name="title" value="' . $row['title'] . '" placeholder="News title:" required>
		  </div>
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
		  <div class="form-group">
		<div class="row">
		  <div class="col">
		  		<div style="margin-top: 15px;"></div>
	<label for="description">Description *</label>
			<textarea id="description" name="description" style="width: 500px; height: 100px;" placeholder="News description:" required>' . $row['description'] . '</textarea>
		  </div>
	  </div>
	  		  <div class="form-group">
		<div class="row">
		  <div class="col">
			<label for="picture">Picture:</label>
			<input type="file" id="picture" name="picture">
		  </div>
	  </div>
			<input type="submit" value="SUBMIT">
		</div>
	  </div>
			</form>
		</div>';
} else {
	print '
		<h2>NEWS</h2>
		<div style="margin-top: 25px;"></div>
		<div id="news">
			<table>
					<tr>
						<th width="10"></th>
						<th width="10"></th>
						<th width="10"></th>
						<th style="text-align:center">TITLE</th>
						<th style="text-align:center">DESCRIPTION</th>
						<th style="text-align:center">DATE</th>
						<th width="10"></th>
					</tr>
				<tbody>';
	$query = "SELECT * FROM news";
	$query .= " ORDER BY date DESC";
	$result = @mysqli_query($MySQL, $query);
	while ($row = @mysqli_fetch_array($result)) {
		print '
					<tr>
						<td><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;id=' . $row['id'] . '"><img src="imgs/user.png" alt="user"></a></td>
						<td><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;edit=' . $row['id'] . '"><img src="imgs/edit.png" alt="uredi"></a></td>
						<td><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;delete=' . $row['id'] . '"><img src="imgs/delete.png" alt="obriši"></a></td>
						<td>' . $row['title'] . '</td>
						<td>';
		if (strlen($row['description']) > 160) {
			echo substr(strip_tags($row['description']), 0, 160) . '...';
		} else {
			echo strip_tags($row['description']);
		}
		print '
						</td>
						<td>' . pickerDateToMysql($row['date']) . '</td>
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
				</tbody>
			</table>
			
		</div>
		<div style="margin-top: 30px;"></div>
		<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink">ADD NEWS</a>';
}

# Close MySQL connection
@mysqli_close($MySQL);
?>