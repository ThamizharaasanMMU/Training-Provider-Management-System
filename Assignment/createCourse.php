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

    <div id="course">
        <h1>Create Course</h1>

        <form name="addCourse" method="post" action="">
            <div>
                <label>Title</label>
                <input name="title" placeholder="e.g. Python For Beginners*" type="text" id="title" onfocus="this.placeholder = 'e.g. Python For Beginners*'" onblur="this.placeholder = 'e.g. Python For Beginners*'" autocomplete="off">
            </div>

            <div>
                <label>Field</label>
                <select id="fieldName" name="fieldName">
                    <option value="Accounting">Accounting</option>
                    <option value="Architecture & Built Environment">Architecture & Built Environment</option>
                    <option value="Environmental Studies">Environmental Studies</option>
                    <option value="Finance & Economics">Finance & Economics</option>
                    <option value="Automotive & Aerospace">Automotive & Aerospace</option>
                    <option value="Hospitality & Culinary Arts">Hospitality & Culinary Arts</option>
                    <option value="Business & Commerce">Business & Commerce</option>
                    <option value="Law & Humanities">Law & Humanities</option>
                    <option value="Media & Communications">Media & Communications</option>
                    <option value="Medicine & Health Science">Medicine & Health Science</option>
                    <option value="Computer Technology">Computer Technology</option>
                    <option value="Food & Nutrition">Food & Nutrition</option>
                    <option value="Design & Creative Arts">Design & Creative Arts</option>
                    <option value="Education">Education</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Social Sciences">Social Sciences</option>
                </select>
            </div>

            <div>
                <label>Description</label>
                <textarea id="description" name="description"></textarea>
            </div>

            <div>
                <label>Start date</label>
                <input type="date" id="startDate" name="startDate">
            </div>
            
            <div>
                <label>End date</label>
                <input type="date" id="endDate" name="endDate">
            </div>

            <div>
                <table border="1">
                    <tr>
                        <th>Instructor</th>
                        <th>Select</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM `users` WHERE `usertype`=4";
                    $result = mysqli_query($connect, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['firstname'] ?> <?php echo $row['lastname']; ?></td>
                        <td><input type="radio" name="radioBtn" value="<?php echo $row['firstname']; ?>"></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <input type="submit" name="create" id="create" value="Create">
            <input type="submit" name="cancel" id="cancel" value="Cancel">
        </form>
    </div>
</div>
</body>
</html>

<?php
include("coursedata.php");
if (isset($_POST["create"])) {
    $stmt = $connect->prepare("SELECT `firstname` FROM `users` WHERE `username` = ?");
    $stmt->bind_param("s", $userN);
    $stmt->execute();
    $stmt->bind_result($firstName);
    $stmt->fetch();
    $creatorN = $firstName;
    $title = $_POST["title"];
    $fieldName = $_POST["fieldName"];
    $desc = $_POST["description"];
    $start = $_POST["startDate"];
    $end = $_POST["endDate"];
    $radio = $_POST["radioBtn"];
    $sql = "INSERT INTO courses (creator_name, title, field, description, start_date, end_date, instructor, ins_invitation, status) 
            VALUES ('$creatorN', '$title', '$fieldName' , '$desc', '$start', '$end', '$radio', 'Pending', 'Draft')";
    $abc = mysqli_query($conn, $sql);
    ?>
    <script>
        alert("Course title: <?php echo $title; ?> created");
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
?>
