<?php

if (isset($_POST["submit"])){
extract($_POST);
$name = $_POST["Q1"];
$email = $_POST["Q2"];
$phone = $_POST["Q3"];
$msg = "$name has left feedback. Call them at $phone or email them at $email. \n\nHere is their message: \n" . $_POST["Q4"];

$to = "nathanrb@cs.utexas.edu";
$subject = "BorrowBrigade Contact Form Submission";
$headers = "From: $email" . "\r\n";

mail($to,$subject,$msg,$headers);

include("header.php");
print<<<HOME
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<h3>Thank you for your feedback. An email has been sent to an administrator.</h3>
</body>
</html>
HOME;
}
else {
  include("header.php");
print<<<FORM
<link rel="stylesheet" href="signup.css">
<style>body{padding:70px;}</style>
<h2>Contact BorrowBrigade</h2>
<form id="contact" method="POST">
  <table>
    <tr>
      <td><b>Full Name:</b></td><td><input type="text" name="Q1" id="Q1"><br><br></td>
    </tr>
    <tr>
      <td><b>Email:</b></td><td><input type="text" name="Q2" id="Q2"><br><br></td>
    </tr>
    <tr>
      <td><b>Phone Number:</b></td><td><input type="text" name="Q3" id="Q3"><br><br></td>
    </tr>
    <tr>
      <td><b>Comments / Suggestions:</b></td><td><textarea rows="5" cols="50" name="Q4" id="Q4"></textarea></td>
    </tr>
  </table>

<div class="buttons" id="entry">
    <input type="submit" name="submit" value="Submit" id="submit">
    <input type="reset" value="Clear">
</div>
</form>
</div>
</body>
</html>
FORM;
}
?>
