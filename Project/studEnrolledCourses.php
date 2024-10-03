<?php 
include("userdata.php"); 
include("coursedata.php");

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
  <title>Student Information</title>
  <link href="css/trainer.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">
  <div id="left">
    <?php include("student.php");?>
  </div>
  <div id="right">
    <h1>My Courses</h1>
    <?php
      $sql = "SELECT * FROM `courses` WHERE `student_list` LIKE '%$studN%'";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);

      if ($count == 0) {
        echo '<p>Oops! You haven\'t enrolled in any course yet</p>';
      } else if ($count > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          if ($row['status'] == 'Publish' && date("Y-m-d") <= $row['start_date']) {
            echo " \n\n";
            echo '<a href="studCourseView.php?view&courseID='.$row['id'].'&visibility=hide"><button type="submit" id="titleBtn" name="button' . $row['id'] . '" value="' . $row['title'] . '">' . $row['title'] . '</button></a>';
          }
        }
      }
    ?>
  </div>
</div>
</body>
</html>
