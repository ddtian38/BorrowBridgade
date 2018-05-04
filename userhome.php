<!DOCTYPE html>
<html>

<?php
include("header.php");
session_start();
if (isset($_SESSION["user"])){
print "<h1>Welcome, " . $_SESSION["user"] . "!</h1>";
print<<<HOME
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
input[type="button"] {
width:15%;
}
</style>
<title> BorrowBrigade </title>
</head>
<body>
<h3>Please choose from the following:</h3>
<form>
<br>&nbsp;<input class="btn btn-success" type="button" onclick="location.href='index.php'" value="Go Home" id="home"><br>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='request.php'" value="Request an Item" id="view"><br>
<br>&nbsp;<input type="button" class="btn btn-info" onclick="location.href='viewpage.php'" value="Search for Items" id="view"><br>
<br>&nbsp;<input type="button" class="btn btn-danger" value="Logout" onclick="location.href='logout.php'"id="logout"><br>
</form>
</body>
HOME;
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
</html>
