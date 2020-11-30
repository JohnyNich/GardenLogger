<?php
include_once "config.php";

// echo "PHP working!";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Check if the connection is successful
if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = "INSERT INTO garden (datetime, moisture, light_intensity, is_raining) VALUES ('".$_POST["date"]."', '".$_POST["moisture"]."', '".$_POST["light_intensity"]."', ".$_POST["raining"].")";

// Since the jQuery code requires a response in the form of "duplicate", I can't add any aditional testing/comfirmation messages, as that'll interfere with the code
if ($con->query($sql) === TRUE) {
  // echo "New record created successfully";
} else {
  // echo "Error: ".$sql."<br>".$con->error; // For bug testing
  if (substr($con->error, 0, 15) === "Duplicate entry") {
    echo "duplicate";
  }
}

$con->close();
?>
