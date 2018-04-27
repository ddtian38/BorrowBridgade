<?php

if(isset($_POST['viewall'])){
unset($_POST['submit']);

  
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

$result = mysqli_query($connect,"SELECT * from items ORDER BY original_location,current_location, category, name");


// Display the results table

print <<<TABLE_START
  <table border="1">
    <tr>
      <th>ID</th><th>ITEM</th><th>CATEGORY</th><th>QUANTITY</th><th>CURRENT LOCATION</th><th>CURRENT POSSESSOR</th><th>ORIGINAL LOCATION</th><th>ORIGINAL POSSESSOR</th>
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
mysqli_close($connect);
}

if(isset($_POST['submit'])){
unset($_POST['viewall']);
extract($_POST);
$id = $_POST["identity"];
$name = $_POST["name"];
$category = $_POST["category"];
$curr_location = $_POST["curr_location"];
$curr_possessor = $_POST["curr_possessor"];
$orig_location = $_POST["orig_location"];
$orig_possessor = $_POST["orig_possessor"];



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

// If there is an id given, use that as the search parameter.

if($id != ""){
  echo "id option";
  $result = mysqli_query($connect,"SELECT * from $table WHERE item_id=$id");
}

elseif($id == "" && $name == "" && $category == "" && $curr_location == "" && $curr_possessor == "" && $orig_location == "" && $orig_possessor == ""){
  echo "no fields option";
  $result = mysqli_query($connect,"SELECT * from $table");
}

else {
  echo "some fields option";
  $querystart = "SELECT * FROM $table ";
  $whereclause = "WHERE ";
  $first = true;

  if($name!=""){
    
    if(!$first){
      $whereclause = $whereclause."AND ";
    }
    $whereclause = $whereclause."name='$name' ";
    $first = false;
  }

  if($category!=""){
    if(!$first){
      $whereclause = $whereclause."AND ";
    }
    $whereclause = $whereclause."category='$category' ";
    $first = false;
  }
  if($curr_location!=""){
    if(!$first){
      $whereclause = $whereclause."AND ";
    }
    $whereclause = $whereclause."current_location='$curr_location' ";
    $first = false;
  }
  if($curr_possessor!=""){
    if(!$first){
      $whereclause = $whereclause."AND ";
    }
    $whereclause = $whereclause."current_possessor='$curr_possessor' ";
    $first = false;
  }
  if($orig_location!=""){
    if(!$first){
      $whereclause = $whereclause."AND ";
    }
    $whereclause = $whereclause."original_location='$orig_location' ";
    $first = false;
  }
  if($orig_possessor!=""){
    if(!$first){
      $whereclause = $whereclause."AND ";
    }
    $whereclause = $whereclause."original_possessor='$orig_possessor' ";
    $first = false;
  }

  echo $querystart.$whereclause;
  $result = mysqli_query($connect,"$querystart$whereclause");

}
//echo $result;

print <<<TABLE_START
  <table border="1">
    <tr>
      <th>ID</th><th>ITEM</th><th>CATEGORY</th><th>QUANTITY</th><th>CURRENT LOCATION</th><th>CURRENT POSSESSOR</th><th>ORIGINAL LOCATION</th><th>ORIGINAL POSSESSOR</th>
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

mysqli_close($connect);

}
?>

<!DOCTYPE html>
<html>
<head>
  <title> View Student Records </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>

<h2>View Student Records</h2>

<form method="post"  action="">
  ID:<br>
  <input type="text" name="identity">
  <br>
  Item name:<br>
  <input type="text" name="name">
  <br>

  Category:<br>
  <select name="category">
    <option value=""></option>
    <option value="Furniture">Furniture</option>
    <option value="Games">Games</option>
    <option value="Appliances">Appliances</option>
    <option value="Tools">Tools</option>
    <option value="Misc">Misc.</option>
  </select><br>

  Current Location:<br>
  <input type="text" name="curr_location">
  <br>
  Current Possessor:<br>
  <select name="curr_possessor">
    <option value=""></option>
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
  </select><br>
  Original Location:<br>
  <input type="text" name="orig_location">
  <br>
  Original Possessor:<br>
  <select name="orig_possessor">
    <option value=""></option>
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
  <input type="submit" name="submit"  value="Submit">
</form> 
<form method="post" action="">
  <input type="submit" name="viewall" value="View All Records">
</form>
</body>
</html>


