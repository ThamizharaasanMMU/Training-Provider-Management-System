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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
</head>
<body>
<div id="wrapper">
    <div id="left">
        <?php include("student.php");?>
    </div>
    <div id="right">
        <h1>View Previous Courses</h1>
        <?php
        $sql = "SELECT * FROM `courses` WHERE `status`= 'Publish'";
        $sql2 = "SELECT * FROM `courses` WHERE `student_list` LIKE '%$studN%'";
        $result = mysqli_query($conn, $sql);	
        $titles = mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($result);//used to count number of rows
        $countTitle = mysqli_num_rows($titles);
        $titleArray = [];

        while($rowList = mysqli_fetch_assoc($titles)) {
            array_push($titleArray, $rowList['title']);
        }

        if ($count == 0) {
            echo '<p>Oops! There is no upcoming course to enroll</p>';
        }
        else if ($count > 0) {
            echo '<table border="1" style="border-collapse: collapse; border: 1px solid black; border-radius: 5px;" cellpadding="5" cellspacing="5">';
            ?>
            <tr>
                <th>Course title</th>
                <th>View</th>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Publish' && date("Y-m-d") > $row['end_date'] && in_array($row['title'], $titleArray)){
                    echo '<tr>';
                    echo '<td>'. $row['title']. '</td>';
                    echo '<td><a href="studCourseView.php?view&courseID='.$row['id'].'&visibility=hide"><i class="material-icons">visibility</i></a></td>';
                    echo '</tr>';
                }
            }
        }

        $titleArray = [];
        echo '</table>'
        ?>
    </div>
</div>
</body>
</html>
