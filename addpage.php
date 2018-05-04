<?php
include("header.php");

if(isset($_POST['submit'])){

extract($_POST);
$name = $_POST["name"];
$category = $_POST["category"];
$quantity = $_POST["quantity"];
$location = $_POST["location"];
$possessor = $_POST["possessor"];

//generate a random unique id for each item entered
$randid = substr(uniqid('', true), -6);
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
$stmt = mysqli_prepare ($connect, "INSERT INTO $table VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
// Assumes that when the item is entered into the db, the original location and possessor are the current location and possessor
mysqli_stmt_bind_param ($stmt, 'sssissss',$randid, $name, $category, $quantity, $location, $possessor, $location, $possessor);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);


mysqli_close($connect);

echo "New item $name added to location $location";

}
?>

<!DOCTYPE html>
<html>
<head>
  <title> Add New Item</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script type ="text/javascript" src = "./insertValidate.js"></script>
</head>
<body>

<h2>Add New Item</h2>

<form id="insert"  method="post"  action="">
  Item Name:<br>
  <input type="text" name="name">
  <br>
<!--
  Category:<br>
  <input type="text" name="category">
  <br>
-->
  Category:<br>
  <select name="category">
    <option value="Furniture">Furniture</option>
    <option value="Games">Games</option>
    <option value="Appliances">Appliances</option>
    <option value="Tools">Tools</option>
    <option value="Misc">Misc.</option>
  </select><br>
  Quantity:<br>
  <input type="number" name="quantity">
  <br>
  Original Location:<br>
  <input type="text" name="location">
  <br>
  Original Possessor:<br>
  <select name="possessor">
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

//print "Connected to ". mysqli_get_host_info($connect) . "<br /><br />\n";

// Get data from a table in the database and print it out
/*
$stmt = mysqli_prepare ($connect, "INSERT INTO $table VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param ($stmt, 'ssssd',$id, $last, $first, $major, $gpa);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
*/
$sql = mysqli_query($connect, "SELECT user_id, first_name, last_name FROM users");
while ($row = $sql->fetch_assoc()){
$userid=$row['user_id'];
echo "<option value=\"$userid\">" . $row['last_name'] . ", " . $row['first_name'] . "</option>";
}
mysqli_close($connect);
?>
  </select>
  <br><br>
  <input type="submit" name="submit"  value="Insert">
</form> 
</body>
</html>
