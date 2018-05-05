<!DOCTYPE html>
<html>

<?php
include("header.php");
session_start();
if (isset($_SESSION["user"])){
print "<h1>Welcome, " . $_SESSION["user"] . "!</h1>";
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
$username = $_SESSION["user"];
$table = "users";
$sql = "SELECT * FROM users WHERE user_id = '$username'";
$stmt = mysqli_query($connect, $sql);
$row = mysqli_fetch_row($stmt);
$fname = $row[2];
$lname = $row[3];
$email = $row[4];
$phone = $row[5];

$stmt->free();
mysqli_close($connect);




print<<<HOME
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>

body{
	left-margin: 500px;
	padding: 100px;
}

#buttons{

        width: 90%;

}

input[type=button]{
width: 15%;
padding: 5px;
}

}
</style>
</head>
<h3>Please choose from the following:</h3>
<div id="buttons">
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='requestpage.php'" value="Request an Item" id="view"><br>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='viewpagev2.php'" value="Search for Items" id="view"><br>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='updateProfile.php'" value="Update Profile Information" id="profileInfo"><br><br>
</div>
HOME;

echo "<div id=\"proflie-info\">";
echo "<h2> Profile Information </h2>";
echo "<p>Name: $fname $lname </p>";
echo "<p>Email: $email </p>";
echo "<p>Phone: $phone </p>";
echo "</div>";




}
else if (isset($_SESSION["admin"])) {
  echo "<h2>Redirecting to Page for Admins...</h2>";
  header ("refresh:1; url=adminhome.php");
}
else{
  echo "<h2>Not logged in - Redirecting...</h2>";
  header("refresh:1; url=login.php");
}
?>
</body>
</html>
