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
    <title>Garden Logger - Edit</title>
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
        <a href="#"><i class="fas fa-edit"></i>Edit</a>
        <a href="settings.php"><i class="fas fa-cog"></i>Settings</a>
	      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </nav>
    <div class="content">
      <h2>Edit</h2>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#add">Add</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#change">Change</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#delete">Delete</a>
        </li>
      </ul>

      <!-- Tabs -->
      <div class="tab-content">
        <div class="tab-pane container active" id="add">
          <form action="add.php" target="dummyframe" method="post">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" required>
            <label for="moisture">Soil moisture</label>
            <input type="number" id="moisture" name="moisture" class="form-control" min="0" max="100" required>
            <label for="light_intensity">Light intensity</label>
            <input type="number" id="light_intensity" name="light_intensity" class="form-control" min="0" max="100" required>
            <label for="raining" 
    </div>
    <!-- This iframe here is basically an invisible tab where the PHP form will run -->
    <iframe name="dummyframe" id="dummyframe" style="display:none;"></iframe>
  </body>
</html>
