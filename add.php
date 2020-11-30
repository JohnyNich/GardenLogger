<?php
include_once "config.php";

// echo "PHP working!";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check if the connection is successful
if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = "INSERT INTO garden (datetime, moisture, light_intensity, is_raining) VALUES ('".$_POST["date"]."', '".$_POST["moisture"]."', '".$_POST["light_intensity"]."', ".$_POST["raining"].")";

if ($con->query($sql) === TRUE) {
  // echo "New record created successfully";
// Stuff below is for future implementation of a system to alert users if there is a duplicate entry
} else {
  // echo "Error: ".$sql."<br>".$con->error; // For bug testing
  if (substr($con->error, 0, 15) === "Duplicate entry") {
    echo "duplicate";
  }
}

$con->close();
?>
