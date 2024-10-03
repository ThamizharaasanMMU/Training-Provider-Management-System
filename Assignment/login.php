<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>Training Providing System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">       
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/login.css" />   
</head>
<body>
<div class="container">
    
    <section class="portal">
        <form name="login-form" action="" method="post" onsubmit="return validateForm()" >
            <div class="title">
                <h1>LOG IN</h1>
                <p class="welcome">Welcome back! Please enter your details.</p>
            </div>
            <br>
            <div class="input-field">
                <input name="username" type="text" id="username" placeholder=" ">
                <label for="username">Username</label>
                
            </div>
            <div class="input-field">
                <input name="password" type="password" id="password" placeholder=" ">
                <label for="password">Password</label>
            </div>
            <p align='center' id="fail"></p>
            <input type="submit" name="login" id="login" value="Log in">
            <br><br>
            <p id="signup">
                Don't have an account?
                <a href="register.php">👋Sign up here👋</a>
            </p>
        </form>
    </section>
   
</div>
</body>

<script>
    function validateForm() {
        var un = document.forms["login-form"]["username"].value;
        var ps = document.forms["login-form"]["password"].value;

        if (un == "" || ps == "") {
            alert("You must fill all the details");
            return false;
        }
    }
</script>

</html>

<?php 
include("userdata.php");

if (isset($_POST["login"])) {
    session_start();
    $userN = $_POST["username"];  	
	$pass = $_POST["password"];
    $_SESSION["username"] = $userN;
    $sql = "SELECT * from users where username = '$userN' and passwords = '$pass' ";
    $abc = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($abc);
    error_reporting(E_ERROR | E_PARSE);
    if ($row['username'] == $userN && $row['passwords'] == $pass) {
        echo "Login success!! Welcome " . $row['firstname'];
        if ($row['usertype'] == 2) {
            header("Location: viewCourse.php");
            exit();
        } else if ($row['usertype'] == 3) {
            header("Location: studEnrolledCourses.php");
            exit();
        } else if ($row['usertype'] == 4) {
            header("Location: insCourses.php");
            exit();
        }
    } else {
        ?>
        <script type="text/javascript">
            document.getElementById("fail").style.color = "red";
            document.getElementById("fail").innerHTML = "Login failed. Try again";
        </script>
        <?php
    }
}
?>

<script>
    function loginFailed() {
        var message = document.getElementById("fail");
        message.innerHTML = "Login failed. Try again";
    }
</script>
