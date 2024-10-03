<?php 
include("coursedata.php"); 
include("userdata.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Instructor</title>
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

	$instructor = $firstName;
	?>

	<div id="wrapper">
		<div id="left">
			<?php include("instructor.php");?>
		</div>

		<div id="right">
			<h1>View Invitations</h1>
			<?php
			$sql = "SELECT * FROM `courses` WHERE `instructor`= '$instructor' AND `ins_invitation`='Pending'";
			$result = mysqli_query($conn, $sql);	
			$count = mysqli_num_rows($result);

			if ($count == 0) {
				echo '<p>Oops! You don\'t have any invitations</p>';
			}
			else if ($count > 0) {
			?>
				<table border="1">
					<tr>
						<th>Course Title</th>
					</tr>
				<?php
				while($row = mysqli_fetch_assoc($result)) {
					if ($row['instructor'] == $instructor){
				?>
						<tr>
							<td>
								<a href="insCourseView.php?view&courseID=<?php echo $row['id']; ?>">
									<?php echo $row['title']; ?>
								</a>
							</td>
						</tr>
				<?php
					}
				}
				?>
				</table>
			<?php
			}
			?>
		</div>
	</div>
</body>
</html>
