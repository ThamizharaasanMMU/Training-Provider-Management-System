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
        <h1>View Courses</h1>
        <?php
        $sql = "SELECT * FROM `courses` WHERE `instructor`= '$instructor' AND `ins_invitation`='Accept'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            echo '<p>Oops! You are not teaching any courses</p>';
            echo '<p>Please wait until a training provider invites you!</p>';
        } else if ($count > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if ($row['instructor'] == $instructor){
                    echo " \n";
                    echo nl2br('<a href="insAcceptedCourse.php?view&courseID= '. $row['id'] .' "><button type="submit" id="titleBtn" name="button' . $row['id'] . '" value="' . $row['title'] . ' ">' . $row['title'] . '<br><hr>Status: ' . $row['status'] . ' </button></a>');
                }
            }
        }
        ?>
    </div>
</div>
</body>
</html>
