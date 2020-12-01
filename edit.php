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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery code I'm using -->
    <script src="script.js"></script>
  </head>
  <body class="loggedin" id="editpage">
    <nav class="navtop">
      <div>
        <h1><a href="home.php">Garden Logger</a></h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="view.php"><i class="fas fa-eye"></i>View</a>
        <a href="#"><i class="fas fa-edit"></i>Edit</a>
        <a href="settings.php"><i class="fas fa-cog"></i>Settings</a>
	      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </nav>
    <div class="content">
      <h2 id='test'>Edit</h2>
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
          <form id="addForm">
            <div class="form-group">
              <label for="date">Date</label>
              <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="moisture">Soil moisture</label>
              <input type="number" id="moisture" name="moisture" class="form-control" min="0" max="100" required>
            </div>
            <div class="form-group">
              <label for="light_intensity">Light intensity</label>
              <input type="number" id="light_intensity" name="light_intensity" class="form-control" min="0" max="100" required>
            </div>
            <div class="form-group">
              <label for="raining">Was it raining?</label>
              <select id="raining" name="raining" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
        <div class="tab-pane container fade" id="change">
          <form id="changeForm">
            <div class="form-group">
              <label for="date">Change entry at date:</label>
              <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
              <p>Below, leave blank any fields that you don't want to stay the same</p>
              <label for="moisture">Soil moisture</label>
              <input type="number" id="moisture" name="moisture" class="form-control" min="0" max="100" required>
            </div>
            <div class="form-group">
              <label for="light_intensity">Light intensity</label>
              <input type="number" id="light_intensity" name="light_intensity" class="form-control" min="0" max="100" required>
            </div>
            <div class="form-group">
              <label for="raining">Was it raining?</label>
              <select id="raining" name="raining" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Chnage</button>
          </form>
        </div>
      </div>
    </div>
    <!-- Modals -->
    <div class="modal" id="alert-duplicate">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal header -->
          <div class="modal-header">
            <h4 class="modal-title">Duplicate alert</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <p>An entry in the table already exists with that date. Only one entry is allowed per date.</p>
            <p>To continue, you can either keep the existing entry in the table, or you can replace it with this entry.<p>
          </div>
          <!-- Modal footer -->
          <div class='modal-footer'>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Do nothing</button>
            <button type="button" id="replace" class="btn btn-danger" data-dismiss="modal">Replace entry</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
