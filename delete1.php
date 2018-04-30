<?php

if(!isset($_POST['submit'])){
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

$result = mysqli_query($connect,"SELECT * from items ORDER BY orig_location,category;");

// Display the results table

print <<<TABLE_START
  <table border="1">
    <tr>
      <th>ID</th><th>ITEM</th><th>CATEGORY</th><th>QUANTITY</th><th>ORIGINAL LOCATION</th><th>ORIGINAL POSSESSOR</th><th>CURRENT LOCATION</th><th>CURRENT POSSESSOR</th>
    <tr>
TABLE_START;
while($row = $result->fetch_row())
{
  
  print <<<TABLE_CONTENT
    <tr>
      <td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td>
    </tr>
TABLE_CONTENT;
}
print <<<TABLE_END
  </table>
TABLE_END;

$result->free();
//unset($_POST['viewall']);
}
// When a move is made
if(isset($_POST['submit'])){

extract($_POST);
$id = $_POST["id"];

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
mysqli_query($connect, "delete from $table WHERE item_id='$id';");

print<<<TABLE_START
  <table border="1">
    <tr>
      <th>ID</th><th>ITEM</th><th>CATEGORY</th><th>QUANTITY</th><th>ORIGINAL LOCATION</th><th>ORIGINAL POSSESSOR</th><th>CURRENT LOCATION</th><th>CURRENT POSSESSOR</th>
    <tr>
TABLE_START;
while($row = $result->fetch_row())
{
  
  print <<<TABLE_CONTENT
    <tr>
      <td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td>
    </tr>
TABLE_CONTENT;
}
print <<<TABLE_END
  </table>
TABLE_END;

// Need to delete rows where the item quantity is 0 and the current location and possessor do not match the original location and possessor
// This indicates that the borrowed item has been returned
// Keeps the db from getting cluttered



$result->free();


mysqli_close($connect);

echo "$quantity $item_name moved to location $locaztion";
$item_query->free();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title> Delete an Item</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script type ="text/javascript" src = "./insertValidate.js"></script>
</head>
<body>

<h2>Delete an Item</h2>

<form id="insert"  method="post"  action="">
  Item ID:<br>
  <input type="text" name="id"><br>
<input type="submit" name="submit"  value="Delete">
</form> 
</body>
</html>
