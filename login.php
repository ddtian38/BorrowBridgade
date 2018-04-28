<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="icon" type="image/png" href="bblogo.jpg">

</head>
<body>
	<div class="header"><img id="logo" src="bblogo.jpg" width="100" height="100">&nbsp;
	<h1>BorrowBrigade</h1></div>
	<div class="nav">
	  <a href="index.html">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="login.php">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="signup.html">Sign-up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="contact.html">Contact</a>
	</div>

<h2>Login</h2><hr>
<?php
  if (!isset($_COOKIE["usertype"])) {

print<<<FORM

<div id="container">
	<div class="row">
		<div class="column">
			<form id="loginForm" method= "post" action="loginVerify.php">		
				<div>
					<label for="user">Username:</label>
					<input type="text" id="user" name="user">
				</div>
				<div>
					<label for="password">Password:</label>
					<input type="password" id="password" name="password">
				</div>
				<div id="buttons">
					<input type="submit" name="register" value="Register">
					<input type="reset" value="Reset">			
				</div>	
			</form>			
		</div>
		<div class="column">
			<div id="firstTimeLogin">
				<h4>First Time Login?</h4>
				<p> If this is your first time logging in, <a href="signup.html">click here </a>to register </p>
			</div>
		</div>
	</div>
</div>

	<div class="footer">
		<p>&copy; BorrowBrigade by DaNaWeiWare 2018 &middot; <a href="mailto:nathanrb@cs.utexas.edu">email</a></p>
		
	</div>		
</body>
</html>
FORM;
}
else {
  $type = $_COOKIE["usertype"];
  $url = $type . "home.php";
  header("location: $url");
}
?>
