<?php
include_once "config.php";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check if the connection is successful
if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql_del = "DELETE FROM garden WHERE datetime = '".$_POST["date"]."'";
$sql_add = "INSERT INTO garden (datetime, moisture, light_intensity, is_raining) VALUES ('".$_POST["date"]."', '".$_POST["moisture"]."', '".$_POST["light_intensity"]."', ".$_POST["raining"].")";

if ($con->query($sql_del) === TRUE) {
  echo "Record successfully deleted";
} else {
  echo "Error: ".$sql_del."<br>".$con->error; // For bug testing
}

if ($con->query($sql_add) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: ".$sql_add."<br>".$con->error; // For bug testing
}

$con->close();
?>
