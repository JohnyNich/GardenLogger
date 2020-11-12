<?php
session_start();
// If the user isn't logged in, we redirect them to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap version 4.5.2 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body class="loggedin">
    <nav class="navtop">
      <div>
        <h1><a href="#">Garden Logger</a></h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="view.php"><i class="fas fa-eye"></i>View</a>
        <a href="edit.php"><i class="fas fa-edit"></i>Edit</a>
        <a href="settings.php"><i class="fas fa-cog"></i>Settings</a>
	      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </nav>
    <div class="content">
      <h2>Home Page</h2>
      <p>Welcome back, <?=$_SESSION['name']?>!</p>
    </div>
  </body>
</html>
