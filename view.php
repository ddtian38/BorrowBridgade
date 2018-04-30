<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="hwk16.css">
<title> Search for Items </title>
<style>
td {text-align:right;}
</style>
</head>
<body>
<h3> Search for Items </h3>

<form method="POST" action="viewResult.php">
<table><tr><td>NAME: <input type="text" name="NAME"></td>
<td>CATEGORY: <input type="text" name="CAT"></td></tr>
<tr><td>OG LOCATION: <input type="text" name="OGL"></td>
<td>OG OWNER: <input type="text" name="OGO"></td></tr>
<tr><td>CURRENT LOCATION: <input type="text" name="CL"></td>
<td>CURRENT OWNER: <input type="text" name="CO"></td></tr></table>
<br><input type="submit" value="Submit">&nbsp;<input type="reset" value="Reset">
<br><br><input type="button" onclick="location.href='all.php';" value="View all Items" />
</form>
</body>
</html>
