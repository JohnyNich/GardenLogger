<?php
include_once "config.php";

$mysqli = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$query = "SELECT * FROM garden";

// Check if any of the form has been submited, by checking if the POST variables have been asignedcx
if (isset($_POST["date"])) {
  // This means that a search is being performed, as a form has been posted through the search button
  $conditions = array();

  if ($_POST["date"] != "") {
    $conditions[0] = "datetime = ".$_POST['date'];
  }

  if ($_POST["moisture"] != "") {
    $conditions[1] = "moisture = ".$_POST['moisture'];
  }

  if ($_POST["light_intensity"] != "") {
    $conditions[2] = "light_intensity = ".$_POST["light_intensity"];
  }

  switch($_POST["raining"]) {
    case "yes":
      $conditions[3] = "is_raining = 1";
      break;
    case "no":
      $conditions[3] = "is_raining = 0";
      break;
    case "either":
  }

  if (count($conditions) != 0) {
    $query = $query." WHERE ";
    $first = true;
    for ($x = 0; $x < 4; $x++) {
      if (isset($conditions[$x])) { // If conditions[x] has been assigned a value...
        if ($first == true) {
          $query = $query.$conditions[$x];
        } else {
          $query = $query." AND ".$conditions[$x];
        }
      }
    }
  }
} // If code isn't run, that means that a form hasn't been submitted (most likely becasue they just opened the view page), so we will just stick with the standard SQL statemtn

// echo $query;

echo '<thead>
  <tr>
    <td>Date & Time</td>
    <td>Soil moisture</td>
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
  echo '</tbody>';
}
