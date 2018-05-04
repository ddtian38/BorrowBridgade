<?php
extract($_POST);
$username = trim($_POST['username']);
if($username === ''){
	echo '';
}
else{
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
//Checking if username exists
$qry  =  "SELECT * FROM users WHERE user_id= '$username'";
//print($qry);
$stmt = mysqli_query($connect, $qry);
$num = mysqli_num_rows($stmt);
if ($num > 0){
	echo "Taken";
}
else{
	echo "Available";

}
}
?>
