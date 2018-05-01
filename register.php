<?php

if (!isset($_COOKIE["usertype"])) {
print<<<PAGE
<!doctype html>
<html lang="en">
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
    <form class="form-signin" method="POST" action="registration.php">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Register an Account</h1>
      <label for="inputFname" class="sr-only">First Name</label>
      <input name="fname" type="text" id="inputFname" class="form-control" placeholder="First Name" required autofocus>
      
      <label for="inputLname" class="sr-only">Last Name</label>
      <input name="lname" type="text" id="inputLname" class="form-control" placeholder="Last name" required>
      
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address" required>
      
      <label for="inputPhone" class="sr-only">Phone</label>
      <input name="phone" type="text" id="inputPhone" class="form-control" placeholder="123-456-7890" required>
      
      <label for="inputUname" class="sr-only">Username</label>
      <input onkeyup="checkUsername();" name="user" type="text" id="inputUname" class="form-control" placeholder="Username" required>
      
      <span id="available"></span>

      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      
      <label for="inputRpassword" class="sr-only">Repeat Password</label>
      <input name="repeatPassword" type="password" id="inputRpassword" class="form-control" placeholder="Repeat Password" required>
      
      <br><button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
<script src="signup.js"></script>  
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
