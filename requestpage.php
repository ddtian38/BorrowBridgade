<?php
session_start();
if (isset($_SESSION["user"])) {
include("header.php");
print<<<PAGE

<!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
    <link href="requestpage.css" rel="stylesheet">

<form class="form-request" method="POST" action="requestpage.php">
      <h1 class="h3 mb-3 font-weight-normal">Please fill out form to request or add an item of your choice. But decide wisely. We are watching you.</h1>
      <div class="form-group>
      <label for="item-requested">Requested Item:</label>
      <input name="item-requested" type="text" id="item-requested" class="form-control" placeholder="Exploding Kittens" required>
      </div>
      <div class="form-group">
      <label for="location-original">Which location is the requested item from:</label>
      <input type="text" name="location-original" id="location-original" class="form-control" required>
      </div>
      <div class="form-group">
      <label for="location-tomove">Where would you like the item to be moved to:</label>
      <input type="text" name="location-tomove" id="location-tomove" class="form-control" required>
      </div>
 	 <div id="buttons">
        <input type="submit" name="submit" value="Submit" class="btn btn-default">
        <input type="reset" value="Reset" class="btn btn-default">
        </div>
    </form>
  </body>
</html>
PAGE;
if(isset($_POST['submit'])){
$itemRequested = $_POST['item-requested'];
$originalLocation = $_POST['location-original'];
$newLocation = $_POST['location-tomove'];

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
$username = $_SESSION["user"];
$table = "users";
$sql = "SELECT * FROM users WHERE user_id = '$username'";
$stmt = mysqli_query($connect, $sql);
$row = mysqli_fetch_row($stmt);
$fname = $row[2];
$lname = $row[3];
$email = $row[4];
$phone = $row[5];

$stmt->free();
mysqli_close($connect);

$to = "danieltian31@yahoo.com";
$subject = "Requesting Item - $itemRequested";
$message = "Per this person's request  $fname $lname would like to $itemRequested to be moved from $originalLocation to $newLocation. \n Here is their contact information. Email: $email. Phone: $phone.";
mail($to, $subject, $message);

echo "<script> window.alert(\"$fname\") </script>";
echo "<script> window.alert(\"Request has been sent. You will be notified soon.\") </script>";
}
}

else {
  $type = $_COOKIE["usertype"];
  $url = $type . "home.php";
  header("location: $url");
}
?>
