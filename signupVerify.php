<html>
<head>
<title>Signup Verification</title>
</head>
<body>
<?php
  extract($_POST);
 $username = trim($_POST['user']);
 $password = trim($_POST['password']);
 $first = trim($_POST['first']);
 $last = trim($_POST['lname']);
 $email = trim($_POST['email']);
 $password = trim($_POST['password']);
 $repeatPwd = trim($_POST['repeatPassword']);

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

$qry  =  "SELECT user_id, password FROM users WHERE user_id=?";
$stmt = mysqli_prepare ($connect, $qry);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if(mysqli_stmt_num_rows($stmt) === 1){
        $result = mysqli_query($connect, "SELECT * FROM users WHERE user_id='$username'");                              
        $row = $result->fetch_row();
        if($password === $row[1]){
                if($row[6] === '1'){
                        $fname = $row[2];
                         echo "<h1>Login Successful</h1><br><h3>Welcome Admin '$fname'. You will be redirected home in 3 seconds...</h3>";
                         //session_start();
                        //header("location: ...... ");
                }
                else{   
                        $fname = $row[2];
                        echo "<h1>Login Successful</h1><br><h3>Welcome '$fname'. You will be redirected home in 3 seconds...</h3>";
                        //session_start();
                        //header("location: ...... ");
                }
        }
        else{
                echo "<h2>Wrong username or password. Please try again.</h2>";
        
        }                       
}
else{
        echo "<h2>Wrong username or password. Please try again.</h2>";

}

?>

</body>
</html>
