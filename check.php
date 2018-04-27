<?php
if(!isset($_POST['user'] || empty($_POST['user']))
{
   echo '0'; exit();
}

$username = trim($_POST['user']);
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
$qry  =  "SELECT *  FROM users WHERE user_id= '$username'";
$stmt = mysqli_query($connect, $qry);
$find = mysqli_stmt_num_rows($stmt); 
echo $find;



}

?>

</body>
</html>
