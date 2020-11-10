<?php
session_start();
// If the user isn't logged in, redirect them to the login page:
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = ''; // Put whatever the database password is between the apostrephes.
$DATABASE_NAME = 'compsci_ia';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Since neither the email nor password was stored in the sessions, we have to get it from the database
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// We can use the account ID that we have stored in the session to get the account info
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap version 4.5.2 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body class="loggedin">
    <nav class="navtop">
      <div>
        <h1><a href="home.php">Garden Logger</a></h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="view.php"><i class="fas fa-eye"></i>View</a>
        <a href="edit.php"><i class="fas fa-edit"></i>Edit</a>
        <a href="settings.php"><i class="fas fa-cog"></i>Settings</a>
			  <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>a
      </div>
    </nav>
    <div class="content">
      <h2>Profile</h2>
      <div>
        <p>Your account details are below:</p>
        <table>
          <tr>
            <td>Username:</td>
            <td><?=$_SESSION['name']?></td>
          </tr>
          <tr>
            <td>Password:</td>
            <td><?=$password?></td>
          </tr>
          <tr>
            <td>Email:</td>
            <td><?=$email?></td>
          </tr>
        </table>
      </div>
    </div>
  </bodY>
</html>
