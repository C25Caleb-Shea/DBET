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
  <body>
    <nav>
      <a href="tracker.php">Tracker</a>
      <a href="running.php">Run</a>
      <a href="swimming.php">Swim</a>
      <a href="lifting.php">Lift</a>
    </nav>
    
    <h1>Nice swim! Your information has been processed.</h1>
<?php
if (isset($_POST["startTime"])) {

  // get next workout id
  $statement = $connection->prepare("SELECT max(workout_id) FROM Workout; ");
  $statement->execute();
  $statement->bind_result($w_id);
  $statement->fetch();
  $w_id++;
  $statement->close();
  $connection->next_result();
  
  // get next swim id
  $statement = $connection->prepare("SELECT max(swim_id) FROM Swim; ");
  $statement->execute();
  $statement->bind_result($s_id);
  $statement->fetch();
  $s_id++;
  $statement->close();
  $connection->next_result();

  // add workout entry
  $statement = $connection->prepare(
      "INSERT INTO Workout (workout_id, user_id, ts) VALUES".
        "(?, 1, ?); "
  );
  $statement->bind_param("is", $w_id, $_POST["endTime"]);
  $statement->execute();
  $statement->close();
  $connection->next_result();
  
  // add swim entry
  $statement = $connection->prepare(
      "INSERT INTO Swim (swim_id, workout_id, meters, reps, time_elapsed) VALUES".
      	"(?, ?, ?, ?, ?);"
  );
  //$statement->bind_param("sss",  $_POST["miles"], $_POST["reps"], $_POST["startTime"]);
  $meters = 4000;
  $reps = 2;
  $statement->bind_param("iiiis", $s_id, $w_id, $meters, $reps, $_POST["startTime"]);
  $statement->execute();

} else {
  // TODO: Handle request without a search query
  echo "wtf (error in swim.php)";
}
 ?>
  </body>
</html>
<?php

// close the database connection
$connection->close();
