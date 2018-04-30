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
<th> USERID </th>
<th> PASSWORD </th>
<th> FIRST NAME </th>
<th> LAST NAME </th>
<th> EMAIL </th>
<th> PHONE </th>
<th> ADMIN </th>
</tr>
TOP;

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

extract($_POST);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$user = $_POST['user'];
$password = $_POST['repeatPassword'];
$phone = $_POST['phone'];
$admin = 0;

$stmt = mysqli_prepare ($connect, "INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param ($stmt, 'sssssss', $user, $password, $fname, $lname, $email, $phone, $admin);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

//$table = "users";
//$sql = mysqli_query($connect, "INSERT INTO $table VALUES ('$user','$password','$fname','$lname','$email', '$phone', '$admin')");
header("location: userhome.php");
//$result = mysqli_query($connect, "SELECT * from $table");
//while ($row = $result->fetch_row())
//{
  //print "<tr>";
  //print "<td> $row[0] </td>";
  //print "<td> $row[1] </td>";
  //print "<td> $row[2] </td>";
  //print "<td> $row[3] </td>";
  //print "<td> $row[4] </td>";
  //print "<td> $row[5] </td>";
  //print "<td> $row[6] </td>";
  //print "</tr>";
//}
//$result->free();
mysqli_close($connect);
?>
