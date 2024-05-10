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

    <h1>Run</h1>

    <img src="Kipchoge.jpg"/>

    <h2>Enter A Run</h2>

    <form action = "run.php" method="POST" onsubmit="return this.checkValidity()">
        
        <label for="weather">Weather:</label>
        <input type="text" id="weather" name="weather" pattern="[A-Za-z -]{1,50}" maxlength ="50" required><br><br>

        <label for="temperature">Temperature:</label>
        <input type="text" id="temperature" name="temperature" maxlength ="10" required><br><br>

        <label for="miles">Miles Ran:</label>
        <input type="number" id="miles" name="miles" step=".001" required><br><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required><br><br>

        <label for="duration">Duration:</label>
        <input type="time" id="duration" name="duration" required><br><br>

        <input type="submit" value="Submit">
    </form>
  
  </center></body>
</html>
