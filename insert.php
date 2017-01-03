<!DOCTYPE html>
<html>
	<head>
		<title>Search Engine in PHP</title>
	</head>

<body bgcolor="gray">
	<form action="insert.php" method="post" enctype="multipart/form-data">
		<table bgcolor="orange" width="500" border="2" cellspacing="2" align="center">
			<tr>
				<td colspan="5" align="center"><h2>Inserting new case:</h2></td>
			</tr>
			<tr>
				<td align="right"><b>CASE Id:</b></td>
				<td><input type="text" name="case_id"></td>
			</tr>

			<tr>
				<td align="right"><b>CASE Description:</b></td>
				<td><textarea cols="39" rows="8" name="case_desc"></textarea></td>
			</tr>

			<tr>
				<td align="right"><b>CASE Keywords:</b></td>
				<td><input type="text" name="case_keywords" size="40"/></td>
			</tr>

			<tr>
				<td align="right"><b>CASE Image:</b></td>
				<td><input type="file" name="case_image" /></td>
			</tr>

			<tr>
				<td align="center" colspan="5"><input type="submit" name="submit" value="Add Case Now"/></td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php
	$conn = mysqli_connect("localhost","root","twiw1534");
	mysqli_select_db($conn, "search");

	if(isset($_POST['submit'])){
		 $case_id = mysqli_real_escape_string($conn, $_POST['case_id']);
		 $case_desc = mysqli_real_escape_string($conn, $_POST['case_desc']);
		 $case_keywords = mysqli_real_escape_string($conn, $_POST['case_keywords']);
		 $case_image = mysqli_real_escape_string($conn, $_FILES['case_image']['name']);
		 $case_image_tmp = mysqli_real_escape_string($conn, $_FILES['case_image']['tmp_name']);
		 /*
		 array(5) { ["name"]=> string(40) "47CE9D43-A61D-4C36-9B39-E75ED2A7C3D1.png" ["type"]=> string(9) "image/png" ["tmp_name"]=> string(50) "/Applications/mampstack-5.6.29-0/php/tmp/phpQ5hVl6" ["error"]=> int(0) ["size"]=> int(59852) }
		  */

		if($case_id=='' OR $case_desc=='' OR $case_keywords=='') {
			echo "<script>alert('please fill all the fields!')</script>";
			exit();
		} else {
			$sql = "INSERT INTO CASES (`case_id`,`case_desc`,`case_keywords`,`case_image`) VALUES ('{$case_id}','{$case_desc}','{$case_keywords}','{$case_image}')";

			move_uploaded_file($case_image_tmp,"images/{$case_image}");
			/*파일을 업로드하면 임시 파일을 images 폴더에 $site_image의 이름으로 저장됨*/

			if(mysqli_query($conn, $sql)){
				echo "<script>alert('Data inserted into table')</script>";
			}
		}
	}
?>