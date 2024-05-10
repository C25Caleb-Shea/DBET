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
    <h1>SK Ultimate Workout Tracker</h1>

    <nav>
      <a href="tracker.php">Tracker</a>
      <a href="running.php">Run</a>
      <a href="swimming.php">Swim</a>
      <a href="lifting.php">Lift</a>
    </nav>
    
    <h1>Nice run! Your information has been processed.</h1>
<?php
if (isset($_POST["weather"])) {

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
  $d = date("Y-m-d");
  $statement->bind_param("is", $w_id, $d);
  $statement->execute();
  $statement->close();
  $connection->next_result();
  
  // add run entry
  $statement = $connection->prepare(
      "INSERT INTO Run (run_id, workout_id, miles, type, time_elapsed) VALUES".
      	"(?, ?, ?, ?, ?);"
  );
  $statement->bind_param("iidss", $r_id, $w_id, $_POST["miles"], $_POST["type"], $_POST["duration"]);
  $statement->execute();

} else {
  // TODO: Handle request without a search query
  echo "wtf (error in run.php)";
}
 ?>
  </center></body>
</html>
<?php

// close the database connection
$connection->close();
