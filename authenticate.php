<?php
session_start();
// Define our variables, which are all the parameters needed to acsess the database
include_once "config.php";
// Connect to the database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check to see if the data from the login form was submitted, isset() will check if the data actually exists
if (!isset($_POST['username'], $_POST['password'])) {
  // If this runs, it means that there wasn't available data in the username and password fields
  exit('Please fill both the username and password fields!');
}

// Prepare our SQL. This prevents an SQL Injection.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
  // Bind parameters (s = string, i = int, etc)
  $stmt->bind_param('s', $_POST['username']); // Takes whatever was in the 'username' field and assigns it to the parameter s
  $stmt->execute(); // Executes the SQL statement held in $stmt, so we can check to see if the account exists in the database
  $stmt->store_result();
  // And now the fun begins
  if($stmt->num_rows > 0) { // Checks if the query returns any results. Essentially, it checks to see if the username exists
    $stmt->bind_result($id, $password);
    $stmt->fetch();
    // Account exists, now we verify the password.
    // Note: remember to use password_hash in registration file to store hashed passwrods
    if (password_verify($_POST["password"], $password)) {
      // Password verifeid.
      // Create sesssions so we know the user is logged in, they basicallya ct like cookies
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['name'] = $_POST['username'];
      $_SESSION['id'] = $id;

      // Now, we will store some frequently-used information from the accounts table as session variables, such as the table that the user has access to
      $_SESSION['table'] = $con->query("SELECT table_select FROM accounts WHERE username = \"" . $_POST['username'] . "\"")->fetch_assoc()["table_select"];
      $_SESSION['location'] = $con->query("SELECT location FROM accounts WHERE username = \"" . $_POST['username'] . "\"")->fetch_assoc()["location"]; // Note: Add "or die($con->error)" to $con->query to find out what's wrong, if an error occurs
      $_SESSION['location_display'] = $con->query("SELECT location_display FROM accounts WHERE username = \"" . $_POST['username'] . "\"")->fetch_assoc()["location_display"]; // Note: Add "or die($con->error)" to $con->query to find out what's wrong, if an error occurs

      header('Location: home.php');
    } else {
      // Incorrect password
      echo "Incorrect username and/or password.";
    }
  } else {
    // Incorrect username
    echo "Incorrect username and/or password.";
  }
  $stmt->close();
}
?>
