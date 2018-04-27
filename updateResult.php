<?php
print<<<TOP
<html>
<head>
<title> Update Student Record </title>
<style>
td, th {border: 1px solid black;}
table {border-collapse:collapse; margin:auto; width:45%; text-align:center;}
</style>
</head>
<body>
<table>
<tr>
<th> ID </th>
<th> LAST NAME </th>
<th> FIRST NAME </th>
<th> MAJOR </th>
<th> GPA </th>
</tr>
TOP;


extract($_POST);
$ID = $_POST["ID"];
$LAST = $_POST["LAST"];
$FIRST = $_POST["FIRST"];
$MAJOR = $_POST["MAJOR"];
$GPA = $_POST["GPA"];

// Connect to the MySQL database
$host = "spring-2018.cs.utexas.edu";
$user = "nathanrb";
$pwd = "helloworld";
$dbs = "cs329e_nathanrb";
$port = "3306";

$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

if (empty($connect))
{
  die("mysqli_connect failed: " . mysqli_connect_error());
}

//print "Connected to ". mysqli_get_host_info($connect) . "<br /><br />\n";

$table = "students";
mysqli_query($connect, "set @last = '$LAST'");
mysqli_query($connect, "set @first = '$FIRST'");
mysqli_query($connect, "set @major = '$MAJOR'");
mysqli_query($connect, "set @gpa = '$GPA'");
$sql = mysqli_query($connect, "UPDATE $table set LAST = CASE WHEN @last != '' THEN @last ELSE LAST END, FIRST = CASE WHEN @first != '' THEN @first ELSE FIRST END, MAJOR =  CASE WHEN @major != '' THEN @major ELSE MAJOR END, GPA = CASE WHEN @gpa != '' THEN @gpa ELSE GPA END where ID = '$ID'");

if($sql){
echo '<script type="text/javascript">alert("Update Successful. Displaying new table now.");</script>';
}
else {
echo '<script type="text/javascript">alert("Error occurred. Update failed.");</script>';
}

// Check if the data has been added properly to the table in the database
$result = mysqli_query($connect, "SELECT * from $table order by LAST");
while ($row = $result->fetch_row())
{
  print "<tr>";
  print "<td> $row[0] </td>";
  print "<td> $row[1] </td>";
  print "<td> $row[2] </td>";
  print "<td> $row[3] </td>";
  print "<td> $row[4] </td>";
  print "</tr>";
}

$result->free();

// Close connection to the database
$connect->close();

print<<<BOTTOM
</table>
</body>
</html>
BOTTOM;
?>
