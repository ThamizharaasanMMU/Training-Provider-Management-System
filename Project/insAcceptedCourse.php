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
<div id="wrapper">
    <div id="left">
        <?php include("instructor.php");?>
    </div>
    <div id="right">
        <?php
        if(isset($_GET['view'])) {
            $courseID = $_GET["courseID"];
            $sql = "SELECT * FROM courses WHERE id= $courseID";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $instructor = $row['instructor'];

            echo '<h1>'.$row['title'].'</h1>';
            echo '<p>Created by: '.$row['creator_name'].'</p>';
            echo '<p>Course Field: '.$row['field'].'</p>';
            echo '<p>Description: '.$row['description'].'</p>';
            echo '<p>Start Date: '.$row['start_date'].'</p>';
            echo '<p>End Date: '.$row['end_date'].'</p>';
        ?>
        <button onclick="back()" type="submit" name="back" id="back">Back</button>
        <script>
            function back() {
                window.location.replace("insCourses.php");
            }
        </script>
        <?php
        }
        ?>
    </div>
</div>
</body>
</html>

<?php
?>
