<?php
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
    <nav>
      <a href="tracker.php">Tracker</a>
      <a href="running.php">Run</a>
      <a href="swimming.php">Swim</a>
      <a href="lifting.php">Lift</a>
    </nav>
    
    <h1>Cleared data.</h1>
<?php
  // get next workout id
  $statement = $connection->prepare("DELETE FROM LSet; ");
  $statement->execute();
  $statement->fetch();
  $statement->close();

 ?>
  </center></body>
</html>
<?php

// close the database connection
$connection->close();
