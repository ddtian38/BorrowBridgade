<?php
include("header.php");
session_start();
if (isset($_SESSION["user"]) || isset($_SESSION["admin"])){
print <<<FORM
	 <link href="login.css" rel="stylesheet">
	<link href="updateProfile.css" rel="stylesheet">
	<style></style>
	<form id="updateContactForm" method= "post">
         <br><br><h1 class="h3 mb-3 font-weight-normal">Please fill out the form to update your information</h1>
	<div class = "form-group">
	<label for="fname"><b>First Name:</label>
	<input type="text" class="form-control" name="fname" id="fname">
	</div>
	<div class = "form-group">
	<label for="lname"><b>Last Name:</b></label>
	<input type="text" name="lname" id="lname" class="form-control">
	</div>
	<div class = "form-group">
	<label for="email"><b>Email:</b></label>
	<input type="text" id="email" name="email" class="form-control">
	</div>
	<div class = "form-group">
	<label for="phone"><b>Phone:</b></label>
	<input class= "form-control" type="text" id="phone" name="phone" pattern = "\d{3}[\-]\d{3}[\-]\d{4}" placeholder="xxx-xxx-xxxx">
	</div>
	<div class = "form-group">
        <label for="newPassword"><b>New password:</b></label>
	<input class = "form-control" type="password" id="newPassword" name="newPassword">
	</div>
		
	<p>Please enter current password to complete the process of updating your profile information.</p>
 	<div class= "form-group">
	<label for="password"><b>Password:</b></label>
	<input type="password" class = "form-control" id="password" name="password">
	</div>	
	<div id="buttons">
	<input type="submit" name="register" value="Register" class="btn btn-default">
	<input type="reset" value="Reset" class="btn btn-default">			
	</div>
	</form>
<script>

var pwdInput = document.getElementById("password");
var form = document.getElementById("updateContactForm");

form.addEventListener("submit", function(e){
        if(pwdInput.value === ''){
        window.alert("Password needs to be filled in order to complete the provess");   
        e.preventDefault();
        return false    
        }
return true;
})
</script>

FORM;

 if(isset($_POST['register'])){
$host = "spring-2018.cs.utexas.edu";
$user = "weiyi";
$pwd = "A2LQHs~cPZ";
$dbs = "cs329e_weiyi";
$port = "3306";

$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

if (empty($connect))
{
  die("mysqli_connect failed: " . mysqli_connect_error());
}

$userPwd = $_POST["password"];
       echo "<script>";
       echo "window.alert(\"Password entered\")";
       echo "</script>";

$username = $_SESSION["user"];
echo "<script> console.log(\"$username\"); </script>";
$qry  =  "SELECT password FROM users WHERE user_id = '$username'";
$stmt = mysqli_query($connect, $qry);
$row = $stmt->fetch_row();

 if($row[0] === $userPwd){

 $newFName  = mysqli_real_escape_string($connect, $_POST['fname']);
 $newLName  = mysqli_real_escape_string($connect, $_POST['lname']);
 $newEmail  = mysqli_real_escape_string($connect, $_POST['email']);
 $newPhone  = mysqli_real_escape_string($connect, $_POST['phone']);
 $newPwd = mysqli_real_escape_string($connect, $_POST['newPassword']);

 mysqli_query($connect, "set @first = '$newFName'");
 mysqli_query($connect, "set @last = '$newLName'");
 mysqli_query($connect, "set @email  = '$newEmail'");
 mysqli_query($connect, "set @phone = '$newPhone'");
 mysqli_query($connect, "set @password = '$newPwd'");



$result = mysqli_query($connect, "UPDATE users set password = CASE WHEN @password != '' THEN @password ELSE password END, first_name = CASE WHEN @first != '' THEN @first ELSE first_name END, last_name = CASE WHEN @last != '' THEN @last ELSE last_name END, email =  CASE WHEN @email != '' THEN @email ELSE email END,phone = CASE WHEN @phone != '' THEN @phone ELSE phone END where user_id = '$username'");
        echo "<script>";
        echo "window.alert(\"Profile information has been successfully updated\")";
        echo "</script>";
}

else{
	echo "<script>";
	echo "window.alert(\"Please input correct passwords\")";
	echo "</script>";
}
} 
}

//If not logged in, redirects client to login page
else{
	echo "<script>window.alert(\"redirecting you to login page\")</script>";
	header("Location: login.php");
    }
?>
</body>
</html>
