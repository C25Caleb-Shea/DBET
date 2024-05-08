<?php
$connection = new mysqli("localhost", "student", "CompSci364",
                         "student");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>RUN.PHP!!!!!!!!!!!!!!!!!!!!!!</title>
  </head>
  <body>
    <nav>
      <a href="tracker.php">Tracker</a>
      <a href="running.php">Run</a>
      <a href="swimming.php">Swim</a>
      <a href="lifting.php">Lift</a>
    </nav>
    
    <h1>Nice run! Your information has been processed.</h1>
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
  
  // get next run id
  $statement = $connection->prepare("SELECT max(run_id) FROM Run; ");
  $statement->execute();
  $statement->bind_result($r_id);
  $statement->fetch();
  $r_id++;
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
  
  // add run entry
  $statement = $connection->prepare(
      "INSERT INTO Run (run_id, workout_id, miles, type, time_elapsed) VALUES".
      	"(?, ?, ?, ?, ?);"
  );
  //$statement->bind_param("sss",  $_POST["miles"], $_POST["reps"], $_POST["startTime"]);
  $miles = 4;
  $reps = 2;
  $statement->bind_param("iiiis", $r_id, $w_id, $miles, $reps, $_POST["startTime"]);
  $statement->execute();

} else {
  // TODO: Handle request without a search query
  echo "wtf (error in run.php)";
}
 ?>
  </body>
</html>
<?php

// close the database connection
$connection->close();
