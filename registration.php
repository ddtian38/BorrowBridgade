<?php
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
/*?8
$stmt = mysqli_prepare ($connect, "INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param ($stmt, 'sssssss', $user, $password, $fname, $lname, $email, $phone, $admin);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
*/

$table = "users";
$sql = mysqli_query($connect, "INSERT INTO $table VALUES ('$user','$password','$fname','$lname','$email', '$phone', '$admin')");
//header("location: userhome.php");
$result = mysqli_query($connect, "SELECT * from $table");
while ($row = $result->fetch_row())
{
  print "LastName = " . $row[0] . " FirstName = " . $row[1].
	" Major = " . $row[2] . " Birthday = " . $row[3] . "<br /><br />\n";
}
$result->free();
mysqli_close($connect);
?>
