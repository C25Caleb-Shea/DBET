<?php
session_start();
$connection = new mysqli("localhost", "student", "CompSci364",
                         "student");
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>SK Workout Tracker</title>
  </head>
  <body><center>
    <h1>SK Ultimate Workout Tracker</h1>

    <nav>
      <a href="tracker.php">Tracker</a>
      <a href="running.php">Run</a>
      <a href="swimming.php">Swim</a>
      <a href="lifting.php">Lift</a>
    </nav>
    
    <h1>Your personal info has been updated.</h1>
<?php

    $u = $_SESSION["username"];
    if ($_POST["height"]) {
      $statement = $connection->prepare("UPDATE User ".
      "SET height = ? WHERE first_name = ?; ");
      $statement->bind_param("is", $_POST["height"], $u);
      $statement->execute();
      $statement->close();
      $connection->next_result();
    }
    if ($_POST["weight"]) {
      $statement = $connection->prepare("UPDATE User ".
      "SET weight = ? WHERE first_name = ?; ");
      $statement->bind_param("is", $_POST["weight"], $u);
      $statement->execute();
      $statement->close();
      $connection->next_result();
    }
 ?>
  </center></body>
</html>
<?php

// close the database connection
$connection->close();
