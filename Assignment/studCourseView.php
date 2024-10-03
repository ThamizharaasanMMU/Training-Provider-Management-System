<?php
include("coursedata.php");
include("userdata.php");

session_start();
$userN = $_SESSION["username"];

$stmt = $connect->prepare("SELECT `firstname` FROM `users` WHERE `username` = ?");
$stmt->bind_param("s", $userN);

$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($firstName);

// Fetch the value
$stmt->fetch();

$studN = $firstName;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student</title>
	<link href="css/trainer.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div id="wrapper">
		<div id="left">
			<?php include("student.php");?>
		</div>
		<div id="right">
			<?php
			if(isset($_GET['view'])) {
				$courseID = $_GET["courseID"];
				$sql = "SELECT * FROM courses WHERE id= $courseID";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$instructor = $row['instructor'];

				echo '<h1> '. $row['title'] .' </h1>';
				echo '<p>Created by : '.$row['creator_name'].' </p>';
				echo '<p>Instructor : '.$row['instructor'].' </p>';
				echo '<p>Course Field : '.$row['field'].' </p>';
				echo '<p>Description : '.$row['description'].' </p>';
				echo '<p>Start Date : '.$row['start_date'].' </p>';
				echo '<p>End Date : '.$row['end_date'].' </p>';
			}
			?>

			<?php
			if(isset($_GET['visibility'])) {
				$visibility = $_GET['visibility'];
				if ($visibility == 'show') {
					include ("sharedButtons.php");
				}
			}
			?>

			<form method="post">
				<input type="submit" name="back" id="back" class="button" value="Back" />
			</form>
		</div>
	</div>
</body>
</html>

<?php
if (isset($_POST["enroll"])) {
	$name = (string)$studN;
	$sql = "UPDATE `courses` SET `student_list` = CONCAT(`student_list`, '$name,') 
			WHERE id = $courseID";
	$abc = mysqli_query($conn,$sql);
?>
	<script>
		alert("You have enrolled in the Course : <?php echo $row['title'] ?> successfully !!");
		window.location.replace("studEnrolledCourses.php");
	</script>
<?php
}

if (isset($_POST["back"])) {
	header("Location: studEnrolledCourses.php");
	exit();
}
?>
