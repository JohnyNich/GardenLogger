<?php
session_start(); // Starts our sessio

echo $_POST["date"]." - ";
echo $_POST["moisture"]." - ";
echo $_POST["light_intensity"]." - ";
// Since checkboxes only post when they are checked, we have to see if the posted variable 'raining' has a set variable
if (isset($_POST["raining"])) { // If the posted varaible 'raining' is set a value...
  echo $_POST["raining"];
} else {
  echo "off";
}
?>
