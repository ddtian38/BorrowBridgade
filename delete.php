<?php
  include("header.php");
  include("deleteResult.php");
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {padding:70px;}
td, th {border: 1px solid black;}
table {border-collapse:collapse; margin:auto; width:45%; text-align:center;}
</style>
<!-- <link rel="stylesheet" type="text/css" href="hwk16.css"> -->
<title> Delete an Item </title>
</head>
<body>
<h3> Delete an Item </h3>

<form method="POST" action="">
ID NUMBER: <input type="text" name="ID" required><br>
<br><input type="submit" name="submit" value="Submit">&nbsp;<input type="reset" value="Reset">
</form>
</body>
</html>
