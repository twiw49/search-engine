<!DOCTYPE html>
<html>
	<head>
		<title>Result Page</title>
		<style>
			.results {
				margin-left: 12%;
				margin-top: 10px;
			}
		</style>
	</head>
	<body bgcolor="#F5DEB3">
		<form action="result.php" method="GET">
			<span><strong>Write your Keyword : </strong></span>
			<input type="text" name="user_query" size="80rem">
			<input type="submit" name="search" value="Search">
		</form>
		<a href="insert.php"><button>Go To Insert Page</button></a>
		<a href="index.html"><button>Go To Search Page</button></a>
<?php
	$conn = mysqli_connect("localhost", "root", "twiw1534");
	mysqli_select_db($conn, "search");

	if(isset($_GET['search'])) {
		$get_value = mysqli_real_escape_string($conn, $_GET['user_query']);
		if ( $get_value == ''  ) {
			echo "<center><b>Please go back, and write something in the search box!</b></center>";
			exit();
		}

		$sql = "SELECT * FROM CASES WHERE `case_keywords` LIKE '%$get_value%'";
		$result = mysqli_query($conn, $sql);

		if ( $result -> num_rows == 0 ) {
			echo "<center><b>Oops! Sorry, nothing was found in the database!</b></center>";

		} else {

			while($row = mysqli_fetch_array($result)) {
				$case_id = htmlspecialchars($row['case_id']);
				$case_desc = htmlspecialchars($row['case_desc']);
				$case_keywords = htmlspecialchars($row['case_keywords']);
				$case_image = htmlspecialchars($row['case_image']);

				echo "
				<div class='result'>
					<h2>$case_id</h2>
					<p align='justify'>$case_keywords</p>
					<p align='justify'>$case_desc</p>
					<img src='images/$case_image' width='100' height='auto'>
				</div><hr>
				";

				/*echo "<div class='result'>"."\n";
				echo "<h2>$site_title</h2>"."\n";
				echo "<a href='{$site_link}' target='_blank'>$site_link</a>"."\n";
				echo "<p align='justify'>$site_desc</p>"."\n";
				echo "<img src='images/$site_image' width='100' height='auto'>"."\n";
				echo "</div><hr>";*/
			}
		}
	}
?>
	</body>
</html>