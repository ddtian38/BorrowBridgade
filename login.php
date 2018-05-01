<?php
if (!isset($_COOKIE["usertype"])) {
print<<<PAGE
<!doctype html>  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
  </head>

  <body class="text-center">
<div class="header"><img id="logo" src="bblogo.jpg" width="100" height="100">&nbsp;
	<h1>BorrowBrigade</h1></div>
	<div class="nav">
	  <a href="index.html">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a id="logged" href="login.php">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="signup.html">Sign-up</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="contact.html">Contact</a>
	</div>    
<form class="form-signin" method="POST" action="https://spring-2018.cs.utexas.edu/cs329e-mitra/nathanrb/FinalProj/loginVerify.php">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name="user" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
PAGE;
}
else {
  $type = $_COOKIE["usertype"];
  $url = $type . "home.php";
  header("location: $url");
}
?>
