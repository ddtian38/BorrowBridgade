<!DOCTYPE html>
<html>

<?php
include("header.php");
session_start();
if (isset($_SESSION["admin"])){
print "<h1>Welcome, " . $_SESSION["admin"] . "!</h1>";
print<<<HOME
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
body{padding:70px;}
input[type="button"] {
width:15%;
}
</style>
<title> BorrowBrigade </title>
</head>
<h3>Please choose from the following:</h3>
<form>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='viewpagev2.php'" value="Search for Items" id="view"><br>
<br>&nbsp;<input class="btn btn-info" type="button" onclick="location.href='addpage.php'" value="Add a New Item" id="insert"><br>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='modifyitem.php'" value="Update an Item" id="update"><br>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='moveitem.php'" value="Move Item(s)" id="view"><br>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='delete.php'" value="Delete an Item" id="delete"><br>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='updateContactInfo.php'" value="Update Profile" id="profileInfo"><br>
</form>
</body>
HOME;
}
else if (isset($_SESSION["user"])) {
  echo "<h2>Redirecting to Page for Users...</h2>";
  header ("refresh:1; url=userhome.php");
}
else {
  echo "<h2>Not logged in - Redirecting...</h2>";
  header("refresh:1; url=login.php");
}
?>
</html>
