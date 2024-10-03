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
        <h1>View Ongoing Courses</h1>
        <?php
        $sql = "SELECT * FROM `courses` WHERE `status`= 'Publish'";
        $sql2 = "SELECT * FROM `courses` WHERE `student_list` LIKE '%$studN%'";
        $result = mysqli_query($conn, $sql);
        $titles = mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($result);
        $countTitle = mysqli_num_rows($titles);
        $titleArray = [];

        while($rowList = mysqli_fetch_assoc($titles)) {
            array_push($titleArray, $rowList['title']);
        }

        if ($count == 0) {
            echo '<p>Oops! There are no upcoming courses to enroll in.</p>';
        } else if ($count > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Publish' && date("Y-m-d") <= $row['start_date'] && !in_array($row['title'], $titleArray)) {
                    echo "\n";
                    echo '<a href="studCourseView.php?view&courseID='.$row['id'].'&visibility=show"><button type="submit" id="titleBtn" name="button' . $row['id'] . '" value="' . $row['title'] . '">' . $row['title'] . '</button></a>';
                }
            }
        }
        ?>
    </div>
</div>
</body>
</html>
