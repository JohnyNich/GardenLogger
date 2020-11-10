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
        <h1><a href="home.php">Garden Logger</a></h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="view.php"><i class="fas fa-eye"></i>View</a>
        <a href="edit.php"><i class="fas fa-edit"></i>Edit</a>
        <a href="settings.php"><i class="fas fa-cog"></i>Settings</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </nav>
    <div class="content">
      <h2>View table</h2>
      <?php
      $DATABASE_HOST = 'localhost';
      $DATABASE_USER = 'root';
      $DATABASE_PASS = ''; // Put whatever the database password is between the apostrephes.
      $DATABASE_NAME = 'compsci_ia';

      $mysqli = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
      $query = "SELECT * FROM garden";

      echo '<table class="table table-hover">
      <thead>
        <tr>
          <td>Date & Time</td>
          <td>Soil Moisture</td>
          <td>Light inensity</td>
          <td>Was it raining?</td>
        </tr>
      </thead>';

      if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) {
          $datetime = $row["datetime"];
          $moisture = $row["moisture"];
          $light_intensity = $row["light_intensity"];
          $is_raining = $row["is_raining"];

          echo '
          <tbody>
          <tr>
            <td>'.$datetime.'</td>
            <td>'.$moisture.'</td>
            <td>'.$light_intensity.'</td>
            <td>';
            if ($is_raining == 0) {
              echo "No";
            } else {
              echo "Yes";
            }
            echo '</td>
          </tr>';
        }
        $result->free();
        echo '</tbody>
        </table>';
      }
      ?>
    </div>
  </body>
</html>
