<?php
session_start();
include_once "config.php";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check if the connection is successful
if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$check = $con->query("SELECT * FROM ".$_SESSION['table']." WHERE datetime = '".$_POST["date"]."'");
$sql_del = "DELETE FROM ".$_SESSION['table']." WHERE datetime = '".$_POST["date"]."'";
$sql_add = "INSERT INTO ".$_SESSION['table']" (datetime, moisture, light_intensity, is_raining) VALUES ('".$_POST["date"]."', '".$_POST["moisture"]."', '".$_POST["light_intensity"]."', ".$_POST["raining"].")";

if (mysqli_num_rows($check) == 0) { // If the entry does NOT exist (meaning the user is trying to change a row that doesn't exist)
  echo "entry does not exist";
} else {
  // Delete action
  if ($con->query($sql_del) === TRUE) {
    echo "Record successfully deleted";
  } else { // If the record is not sucsessfully deleted, that means it doesn't exist. This will only occur if someone is using the 'change' function, nad trying to change a non-existent entry
    echo "Error: ".$sql_del."<br>".$con->error; // For bug testing
  }
  // Add action
  if ($con->query($sql_add) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: ".$sql_add."<br>".$con->error; // For bug testing
  }
}

$con->close();
?>
