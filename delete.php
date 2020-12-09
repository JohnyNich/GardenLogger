<?php
include_once "config.php";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check if the connection is successful
if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$parameters = array();
$order = array("datetime", "moisture", "light_intensity", "is_raining");

$count = 0;
foreach ($_POST as $value) {
  if (($value == "") || ($value == "either")) {
    $parameters[$count] = $order[$count];
  } else {
    $parameters[$count] = "'".$value."'";
  }
  $count += 1;
}

$where = "datetime = ".$parameters[0]." AND moisture = ".$parameters[1]." AND light_intensity = ".$parameters[2]." AND is_raining = ".$parameters[3];
$check = $con->query("SELECT * FROM garden WHERE ".$where);
$sql = "DELETE FROM garden WHERE ".$where;

if (mysqli_num_rows($check) == 0) { // If the entry does NOT exist (meaning the user is trying to change a row that doesn't exist)
  echo "entry does not exist";
} else {
  if ($con->query($sql) === TRUE) {
    echo "Record successfully deleted";
  } else { // If the record is not sucsessfully deleted, that means it doesn't exist. This will only occur if someone is using the 'change' function, nad trying to change a non-existent entry
    echo "Error: ".$sql."<br>".$con->error; // For bug testing
  }
}

$con->close();
?>
