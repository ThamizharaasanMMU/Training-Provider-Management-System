<?php
include("coursedata.php");
include("userdata.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Training Provider</title>
	<link href="css/trainer.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<?php
	session_start();
	$userN = $_SESSION["username"];
	$stmt = $connect->prepare("SELECT `firstname` FROM `users` WHERE `username` = ?");
	$stmt->bind_param("s", $userN);
	$stmt->execute();
	// Bind the result to a variable
	$stmt->bind_result($firstName);
	// Fetch the value
	$stmt->fetch();
	$creator = $firstName;
	?>

	<div id="wrapper">
		<div id="left">
			<?php include("trainer.php");?>
		</div>
		<div id="right">
			<h1>View Courses</h1>
			<?php
			$sql = "SELECT * FROM `courses` WHERE `creator_name`= '$creator'";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result); //used to count number of rows

			if ($count == 0) {
				echo '<p>Oops! There is no course to view</p>';
				echo '<p>Wanna create one?</p>';
			} else if ($count > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					if ($row['creator_name'] == $creator) {
						echo "\n";
						echo '<a href="courseDetail.php?view&courseID=' . $row['id'] . '"><button type="submit" id="titleBtn" name="button' . $row['id'] . '" value="' . $row['title'] . '">' . $row['title'] . '<br><hr>Instructor Status : ' . $row['ins_invitation'] . '</button></a>';
					}
				}
			}
			?>
		</div>
	</div>
</body>
</html>
