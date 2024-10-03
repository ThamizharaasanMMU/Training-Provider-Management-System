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
?>

<div id="wrapper">
    <div id="left">
        <?php include("trainer.php");?>
    </div>
    <div id="course">
        <?php
        if(isset($_GET['view']))
        {
            $courseID = $_GET["courseID"];
            $sql = "SELECT * FROM courses WHERE id = $courseID";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $instructor = $row['instructor'];
            echo '<h1> '. $row['title'] .' </h1>';
        ?>

        <form name="addCourse" method="post" action="">
            <?php if ($row['ins_invitation'] == "Accept") { ?>
                <label class="lbl">Publish </label>
                <input type="checkbox" name="switch" id="switch" class="checkbox" >
                <label for="switch" class="toggle"></label>
            <?php } ?>

            <div>
                <label>Title</label>
                <input name="title" type="text" value="<?php echo $row['title']; ?>">
            </div>

            <div>
                <label>Field</label>
                <?php
                $default_state = $row['field'];
                $fields = array("Accounting", "Architecture & Built Environment", "Environmental Studies", "Finance & Economics", "Automotive & Aerospace", "Hospitality & Culinary Arts", "Business & Commerce", "Law & Humanities", "Media & Communications", "Medicine & Health Science", "Computer Technology", "Food & Nutrition", "Design & Creative Arts", "Education", "Engineering", "Social Sciences");
                $fields2 = array_diff($fields, array($default_state));
                ?>
                <select id="fieldName" name="fieldName">
                    <option value='<?php echo $default_state?>' selected='selected'><?php echo $default_state?></option>
                    <?php
                    foreach ($fields2 as $field) {
                        echo "<option value='$field'>$field</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label>Description</label>
                <textarea cols="60" rows="4" name="desc"><?php echo $row['description']; ?></textarea>
            </div>

            <div>
                <label>Start date</label>
                <input type="date" id="startDate" name="startDate" value="<?php echo $row['start_date']; ?>">
            </div>

            <div>
                <label>End date</label>
                <input type="date" id="endDate" name="endDate" value="<?php echo $row['end_date']; ?>">
            </div>

            <div>
                <table border="1">
                    <tr>
                        <th>Instructor</th>
                        <th>Select</th>
                    </tr>
                    <?php
                    if ($row['status'] == "Publish") {
                        ?><script>document.getElementById("switch").checked = true;</script><?php
                    }
                    else if ($row['status'] == "Draft") {
                        ?><script>document.getElementById("switch").checked = false;</script><?php
                    }

                    $sql = "SELECT * FROM `users` WHERE `usertype`=4";
                    $result = mysqli_query($connect, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['firstname'] ?> <?php echo $row['lastname']; ?></td>
                        <td><input type="radio" name="radioBtn" id="<?php echo $row['firstname']; ?>" value="<?php echo $row['firstname']; ?>"></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <input type="submit" name="update" id="update" value="Update">
            <input type="submit" name="cancel" id="cancel" value="Cancel">
            <input type="submit" name="delete" id="delete" value="Delete">
        </form>

        <script>
            let radBtnDefault = document.getElementById("<?php echo $instructor; ?>");
            radBtnDefault.checked = true;
        </script>
        <?php
        }
        ?>
    </div>
</div>
</body>
</html>

<?php
include("coursedata.php");
if (isset($_POST["update"])) {
    error_reporting(E_ERROR | E_PARSE);
    $stmt = $connect->prepare("SELECT `firstname` FROM `users` WHERE `username` = ?");
    $stmt->bind_param("s", $userN);
    $stmt->execute();
    $stmt->bind_result($firstName);
    $stmt->fetch();
    $creatorN = $firstName;
    $title = $_POST["title"];
    $fieldName = $_POST["fieldName"];
    $desc = $_POST["desc"];
    $start = $_POST["startDate"];
    $end = $_POST["endDate"];
    $radio = $_POST["radioBtn"];
    $check = $_POST["switch"];
    $status;

    if ($check == "on") {
        $status = "Publish";
    }
    else {
        $status = "Draft";
    }

    $sql = "UPDATE courses SET title = '$title', field = '$fieldName', description = '$desc', start_date = '$start', end_date = '$end', instructor = '$radio', status = '$status' WHERE id = $courseID";
    $abc = mysqli_query($conn,$sql);
?>

    <script>
        alert("Course title: <?php echo $title; ?> updated");
        window.location.replace("viewCourse.php");
    </script>
<?php
}

if (isset($_POST["cancel"])) {
?>
    <script>
        window.location.replace("viewCourse.php");
    </script>
<?php
}

if (isset($_POST["delete"])) {
    error_reporting(E_ERROR | E_PARSE);
    $title = $_POST["title"];
    $sql = "DELETE FROM `courses` WHERE `title` = '$title'";
    $abc = mysqli_query($conn,$sql);
?>
    <script>
        alert("Course title: <?php echo $title; ?> deleted");
        window.location.replace("viewCourse.php");
    </script>
<?php
}
?>
