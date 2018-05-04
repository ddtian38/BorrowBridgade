<?php
if (!isset($_COOKIE["usertype"])) {
include("header.php");
print<<<PAGE
<head>
<!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
</head>
<form class="form-signin" method="POST" action="loginVerify.php">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name="user" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
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
