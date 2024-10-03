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
if (isset($_GET['view'])) {
    $courseID = $_GET["courseID"];
    $sql = "SELECT * FROM courses WHERE id= $courseID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $instructor = $row['instructor'];

    echo '<div id="wrapper">';
    echo '<div id="left">';
    include("instructor.php");
    echo '</div>';
    echo '<div id="right">';
    echo '<h1>'. $row['title'] .'</h1>';
    echo '<p>Created by: '.$row['creator_name'].'</p>';
    echo '<p>Course Field: '.$row['field'].'</p>';
    echo '<p>Description: '.$row['description'].'</p>';
    echo '<p>Start Date: '.$row['start_date'].'</p>';
    echo '<p>End Date: '.$row['end_date'].'</p>';
    echo '<form method="post" class="button-container">';
    echo '<input type="submit" name="accept" id="accept" class="button" value="Accept" />';
    echo '<input type="submit" name="reject" id="reject" class="button" value="Reject" />';
    echo '</form>';
    echo '</div>';
    echo '</div>';
}

if (isset($_POST["accept"])) {
    $sql = "UPDATE courses SET ins_invitation = 'Accept' WHERE id = $courseID";
    $abc = mysqli_query($conn, $sql);
    header("Location: insCourses.php");
    exit();
}

if (isset($_POST["reject"])) {
    $sql = "UPDATE courses SET ins_invitation = 'Reject' WHERE id = $courseID";
    $abc = mysqli_query($conn, $sql);
    header("Location: insCourses.php");
    exit();
}
?>

</body>
</html>
