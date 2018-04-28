<?php
print<<<TOP
<html>
<head>
<title> View Student Record </title>
<style>
td, th {border: 1px solid black;}
table {border-collapse:collapse; margin:auto; width:75%; text-align:center;}
</style>
</head>
<body>
<table>
<tr>
<th> ITEM ID </th>
<th> NAME </th>
<th> CATEGORY </th>
<th> QUANTITY </th>
<th> ORIGINAL LOCATION </th>
<th> ORIGINAL OWNER</th>
<th> CURRENT LOCATION </th>
<th> CURRENT OWNER </th>
</tr>
TOP;

extract($_POST);
$ID = $_POST["ID"];
$LAST = $_POST["LAST"];
$FIRST = $_POST["FIRST"];

// Connect to the MySQL database
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

//print "Connected to ". mysqli_get_host_info($connect) . "<br /><br />\n";

// Get data from a table in the database and print it out

$table = "items";
$result = mysqli_query($connect, "SELECT * from $table order by name;");
while ($row = $result->fetch_row())
{
  print "<tr>";
  print "<td> $row[0] </td>";
  print "<td> $row[1] </td>";
  print "<td> $row[2] </td>";
  print "<td> $row[3] </td>";
  print "<td> $row[4] </td>";
  print "<td> $row[5] </td>";
  print "<td> $row[6] </td>";
  print "<td> $row[7] </td>";
  print "</tr>";
}

$result->free();

// Close connection to the database
mysqli_close($connect);

print<<<BOTTOM
</table>
</body>
</html>
BOTTOM;
?>
