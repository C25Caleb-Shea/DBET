<?php
session_start();
if (! isset($_SESSION["username"])) {
  header("Location: index.php?redirect=".$_SERVER["PHP_SELF"]);
}
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

    <h1>Update User Information</h1>

    <img src="ronnie.jpg"/>

    <h2>Update Personal Data</h2>
    
    <p>Leave a field blank to leave it unchanged</p>

    <form action = "up.php" method="POST" onsubmit="return this.checkValidity()">
        
        <label for="height">Height (in):</label>
        <input type="number" id="height" name="height" step=".1"><br><br>

        <label for="weight">Weight (lbs):</label>
        <input type="number" id="weight" name="weight" step=".1"><br><br>

        <input type="submit" value="Submit">
    </form>
  
  </center></body>
</html>
