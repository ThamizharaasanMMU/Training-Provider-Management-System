<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Training Providing System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&lang=en">
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/register.css" />
</head>

<body>
  <div class="container">
    <form name="register-form" method="post" action="" onsubmit="return validateForm()">
      <div class="title">
        <h1>Registration page</h1>
      </div>

      <div class="input-field">
        <label>First Name</label>
        <input name="firstName" placeholder="e.g. Thamizharaasan*" type="text" id="firstName"
          onfocus="this.placeholder = 'e.g. Thamizharaasan*'" onblur="this.placeholder = 'e.g. Thamizharaasan*'"
          autocomplete="off">
        <br><br>

        <label>Last Name</label>
        <input name="lastName" placeholder="e.g. Chandran*" type="text" id="lastName"
          onfocus="this.placeholder = 'e.g. Chandran*'" onblur="this.placeholder = 'e.g. Chandran*'" autocomplete="off">
      </div>

      <div class="userType">
        <label for="user-type">User Type</label>
        <select id="user-type" name="user-type">
          <option value="1"></option>
          <option value="2">Training Provider</option>
          <option value="3">Student</option>
          <option value="4">Instructor</option>
        </select>
      </div>

      <div class="input-field">
        <label>Username</label>
        <input name="username" placeholder="e.g. Thamizh02*" type="text" id="username"
          onfocus="this.placeholder = 'e.g. Thamizh02*'" onblur="this.placeholder = 'e.g. Thamizh02*'"
          autocomplete="off">
      </div>

      <div class="input-field">
        <label>Password</label>
        <input name="password" placeholder="Enter your password" type="password" id="password"
          onfocus="this.placeholder = 'Enter your password'" onblur="this.placeholder = 'Enter your password'"
          autocomplete="off">
      </div>

      <input type="submit" name="register" value="Register" class="register"><br><br>
    </form>
    <p id="login">Already have an account?
      <a href="login.php">👋Log in here👋</a>
    </p>
  </div>

  <script>
    function validateForm() {
      var fN = document.forms["register-form"]["firstName"].value;
      var lN = document.forms["register-form"]["lastName"].value;
      var uT = document.forms["register-form"]["user-type"].value;
      var uN = document.forms["register-form"]["username"].value;
      var pass = document.forms["register-form"]["password"].value;

      if (fN == "" || lN == "" || uT == 1 || uN == "" || pass == "") {
        alert("You must fill all the details");
        return false;
      }
    }
  </script>
</body>

</html>

<?php 
include("userdata.php");
if(isset($_POST["register"])) 	
{
    $firstN = $_POST["firstName"];
    $lastN = $_POST["lastName"];
    $userType =  $_POST["user-type"];
    $userN = $_POST["username"];  	
    $pass = $_POST["password"];  	
 
	$sql = "INSERT INTO users (firstname, lastname, usertype, username, passwords) 
	VALUES ('$firstN', '$lastN', '$userType' , '$userN', '$pass')";
	
	$abc = mysqli_query($connect,$sql);

	if (!$abc) {
		die ("Cannot save");
	}
	else {
		echo "Data saved";
        header("Location: login.php");
        exit();
	}
}
?>
