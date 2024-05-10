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
    <script src="add_set.js" defer></script>
  </head>

  <body><center>
    <h1>SK Ultimate Workout Tracker</h1>

    <nav>
      <a href="tracker.php">Tracker</a>
      <a href="running.php">Run</a>
      <a href="swimming.php">Swim</a>
      <a href="lifting.php">Lift</a>
    </nav>

    <img src="arnold2.jpg"/>

    <h2>Session Details</h2>

    <form class="lift" action="lift.php" method="POST" onsubmit="return this.checkValidity()"">
      <!-- Lift metadata -->
      <label for="startTime">Start Time:</label>
      <input type="time" id="startTime" name="startTime" required>
      
      <label for="weather">Weather:</label>
      <input type="text" id="weather" name="weather" pattern="[A-Za-z -]{1,50}" maxlength="50" required>
      
      <label for="temperature">Temperature:</label>
      <input type="temperature" id="temperature" name="temperature" maxlength="3" required><br><br>
      
      

      <input class="submit" type="submit" value="Submit">
    </form>
  </center></body>
</html>
