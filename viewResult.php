<?php
print<<<TOP
<html>
<head>
<title> View Student Record </title>
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

// Get data from a table in the database and print it out

$table = "students";
$sql1 = "SELECT * from $table WHERE ID='$ID'";
$sql2 = "SELECT * from $table WHERE LAST='$LAST'";
$sql3 = "SELECT * from $table WHERE FIRST='$FIRST'";
$sql4 = "SELECT * from $table WHERE LAST='$LAST' AND FIRST='$FIRST'";
if ($ID !== ''){
    $result = mysqli_query($connect, $sql1);  
}
else {
    if($LAST == '' && $FIRST != ''){
        $result = mysqli_query($connect, $sql3);
    }
    else if($LAST != '' && $FIRST == ''){
        $result = mysqli_query($connect, $sql2);
    }
    else if($LAST != '' && $FIRST != ''){
        $result = mysqli_query($connect, $sql4);
    }   
}

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
mysqli_close($connect);

print<<<BOTTOM
</table>
</body>
</html>
BOTTOM;
?>
