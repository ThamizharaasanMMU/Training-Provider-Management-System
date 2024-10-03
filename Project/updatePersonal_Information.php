<?php
include("userdata.php");
session_start();
$userN = $_SESSION["username"];

$sql = "SELECT * FROM `users` WHERE `username` = '$userN'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
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
  <div id="course">
    <form name="updateInfo" method="post" action="">
      <div>
        <label>First Name</label>
        <input name="fname" id="fname" type="text" value="<?php echo $row['firstname']; ?>">
      </div>
      <div>
        <label>Last Name</label>
        <input name="lname" id="lname" type="text" value="<?php echo $row['lastname']; ?>">
      </div>
      <div>
        <label>Date of Birth</label>
        <input name="dob" id="dob" type="date" value="<?php echo $row['date_of_birth']; ?>">
      </div>
      <div>
        <label>Phone Number</label>
        <input name="phone" id="phone" type="number" value="<?php echo $row['phone']; ?>">
      </div>
      <div>
        <label>Email</label>
        <input name="email" id="email" type="text" value="<?php echo $row['email']; ?>">
      </div>
      <div>
        <label>Institute</label>
        <input name="institute" id="institute" type="text" value="<?php echo $row['institute']; ?>">
      </div>
      <div>
        <label>Field of Study</label>
        <input name="field" id="field" type="field" value="<?php echo $row['field_of_study']; ?>">
      </div>
      <input type="submit" name="update" id="update" value="Update">
      <input type="submit" name="cancel" id="cancel" value="Cancel">
    </form>
  </div>
</div>
</body>
</html>

<?php
if (isset($_POST["update"])) {
    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $institute = $_POST['institute'];
    $field = $_POST['field'];

    $sql = "UPDATE users SET firstname = '$fName', lastname = '$lName',
    date_of_birth = '$dob', phone = '$phone', email = '$email', institute = '$institute', field_of_study = '$field' WHERE `username` = '$userN'";

    $abc = mysqli_query($connect,$sql);
?>
    <script>
        alert ("Student details updated !!");
        window.location.replace("studEnrolledCourses.php");
    </script>
<?php
}
?>

<?php
if (isset($_POST["cancel"])) {
?>
    <script>
        window.location.replace("studEnrolledCourses.php");
    </script>
<?php
}
?>
