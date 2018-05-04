<?php
include("header.php");
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

// Get the item that you are moving in the table
$item_query = mysqli_query($connect, "SELECT * FROM $table WHERE item_id='$id';");
$row = $item_query->fetch_assoc();

// Create a new row in the db with the quantity of item moved to a different current location
$stmt = mysqli_prepare ($connect, "INSERT INTO $table VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param ($stmt, 'sssissss',$randid, $row['name'], $row['category'], $quantity, $row['orig_location'], $row['orig_possessor'],$location,$possessor);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Modify the original entry by reducing the quantity by the amount that was moved
$new_quantity = $row['quantity']-$quantity;
$update_id = $row['item_id'];

mysqli_query($connect, "UPDATE $table SET quantity=$new_quantity WHERE item_id='$update_id';");

$item_name = $row['name'];
$ol = $row['orig_location'];
$op = $row['orig_possessor'];
// Combine the quantities of rows that have the same item name, current_location, current_possessor

// Count the number of rows with that particular item name, current_location, and current_possessor
$same_item = mysqli_query($connect, "SELECT * FROM items where name='$item_name' AND current_location='$location' AND current_possessor='$possessor' AND orig_location='$ol' AND orig_possessor='$op'");
$row_count = $same_item->num_rows;
$same_item_arr = $same_item->fetch_row();
$first_id = $same_item_arr[0];

if($row_count>=2){
  $sum_query = mysqli_query($connect,"SELECT SUM(quantity) FROM items WHERE name='$item_name' AND current_location='$location' AND current_possessor='$possessor' GROUP BY name,current_location,current_possessor");
  //echo $sum_query->num_rows;
  $sum_arr = $sum_query->fetch_row();
  $total_quant = $sum_arr[0];
  mysqli_query($connect, "UPDATE items SET quantity = $total_quant WHERE item_id='$first_id'");
  mysqli_query($connect, "UPDATE items SET quantity = 0 WHERE item_id!='$first_id' AND  name='$item_name' AND current_location='$location' AND current_possessor='$possessor' AND orig_location='$ol' AND orig_possessor='$op'");
  mysqli_query($connect, "DELETE FROM items WHERE quantity = 0 AND item_id!='$first_id' AND name='$item_name' AND current_location='$location' AND current_possessor='$possessor' AND orig_location='$ol' AND orig_possessor='$op'");
}

// Need to delete rows where the item quantity is 0 and the current location and possessor do not match the original location and possessor
// This indicates that the borrowed item has been returned
// Keeps the db from getting cluttered
mysqli_query($connect, "DELETE FROM $table WHERE (quantity=0 AND (current_location != orig_location OR current_possessor != orig_possessor))");


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

// Need to delete rows where the item quantity is 0 and the current location and possessor do not match the original location and possessor
// This indicates that the borrowed item has been returned
// Keeps the db from getting cluttered



$result->free();
//unset($_POST['viewall']);


mysqli_close($connect);

echo "$quantity $item_name moved to location $location";
$item_query->free();
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

<h2>Move Item</h2>

<form id="insert"  method="post"  action="">
  Item ID:<br>
  <input type="text" name="id">
  <br>
  Quantity:<br>
  <input type="number" name="quantity">
  <br>
  New Location:<br>
  <input type="text" name="location">
  <br>
  New Possessor:<br>
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

$sql = mysqli_query($connect, "SELECT user_id, first_name, last_name FROM users");
while ($row = $sql->fetch_assoc()){
$userid=$row['user_id'];
echo "<option value=\"$userid\">" . $row['last_name'] . ", " . $row['first_name'] . "</option>";
}
mysqli_close($connect);
?>
  </select>
  <br><br>
  <input type="submit" name="submit"  value="Move">
</form> 
</body>
</html>
