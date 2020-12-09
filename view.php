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
    <title>Garden Logger - View</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap version 4.5.2 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript/jQuery code I'm using -->
    <script src="script.js"></script>
  </head>
  <body class="loggedin">
    <nav class="navtop">
      <div>
        <h1><a href="home.php">Garden Logger</a></h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="#"><i class="fas fa-eye"></i>View</a>
        <a href="edit.php"><i class="fas fa-edit"></i>Edit</a>
        <a href="settings.php"><i class="fas fa-cog"></i>Settings</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </nav>
    <div class="content">
      <h2>View table</h2>
      <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-primary btn-block">Search</button>
      <div id="search" class="collapse">
        <form method="post">
          <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" class="form-control">
          </div>
          <div class="form-group">
            <label for="moisture">Soil moisture:</label>
            <input type="number" id="moisture" name="moisture" min="0" max="100" step="1" class="form-control">
          </div>
          <div class="form-group">
            <label for="light_intensity">Light intensity:</label>
            <input type="number" id="light_intensity" name="light_intensity" min="0" max="100" step="1" class="form-control">
          </div>
          <div class="form-group">
            <label for="raining">Was it raining?</label>
            <select class="form-control" name="raining" id="raining">
              <option value="yes">Yes</option>
              <option value="no">No</option>
              <option value="either" selected>Either</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Search</button>
      </div>
      <table class="table table-hover" id="table"></table>
    </div>
  </body>
</html>
