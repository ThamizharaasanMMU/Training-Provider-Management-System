<?php include("userdata.php"); ?>

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
	?>

	<div id="wrapper">
		<div id="left">
			<?php include("trainer.php");?>
		</div>

		<div id="right">
			<h1>View Instructor</h1>
			<table border="1">
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
				</tr>
				
				<?php
				$sql = "SELECT * FROM `users` WHERE `usertype`=4";
				$result = mysqli_query($connect, $sql);	
				
				while($row = mysqli_fetch_assoc($result))
				{
				?>			

				<tr>
					<td><?php echo $row['firstname']; ?></td>
					<td><?php echo $row['lastname']; ?></td>
				</tr>
				
				<?php
				}
				?>
			</table>

			<button onclick="back()" type="submit" name="back" id="back">Back</button>

			<script>
				function back() {
					window.location.replace("viewCourse.php");
				}
			</script>
		</div>
	</div>
</body>
</html>
