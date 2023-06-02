<?php

if (isset($action) && $action != '') {
	$query = "SELECT * FROM news";
	$query .= " WHERE id=" . $_GET['action'];
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	print '
			<div class="news">
				<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<h2>' . $row['title'] . '</h2>
				<p>' . $row['description'] . '</p>
				<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
				<hr style="margin-bottom: 1px;">
		        <a href="index.php?menu=2">&larr; Back to News</a>
			</div>';
} else {
	print '<h1>NEWS</h1>';
	$query = "SELECT * FROM news";
	$query .= " WHERE archive='N'";
	$query .= " ORDER BY date DESC";
	$result = @mysqli_query($MySQL, $query);
	while ($row = @mysqli_fetch_array($result)) {
		print '
			<div class="news">
				<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<h2>' . $row['title'] . '</h2>';
		if (strlen($row['description']) > 100) {
			echo substr(strip_tags($row['description']), 0, 100) . '... <a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '">More</a>';
		} else {
			echo strip_tags($row['description']);
		}
		print '
                <br>
                <br>
				<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
				<hr>
			</div>';
	}
}
?>