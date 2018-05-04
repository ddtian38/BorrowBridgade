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
  header("refresh:1; url=contact.html");
}
?>
