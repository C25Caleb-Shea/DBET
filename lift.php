<?php
$connection = new mysqli("localhost", "student", "CompSci364",
                         "student");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>LIFT.PHP^^^^^^^^^^^^^^^^^^</title>
  </head>
  <body>
    <nav>
      <a href="tracker.php">Tracker</a>
      <a href="running.php">Run</a>
      <a href="swimming.php">Swim</a>
      <a href="lifting.php">Lift</a>
    </nav>
    
    <h1>Nice lift! Your information has been processed.</h1>
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
  
  // get next lift id
  $statement = $connection->prepare("SELECT max(lift_id) FROM Lift; ");
  $statement->execute();
  $statement->bind_result($l_id);
  $statement->fetch();
  $l_id++;
  $statement->close();
  $connection->next_result();
  
  // get next set id
  $statement = $connection->prepare("SELECT max(set_id) FROM LSet; ");
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
  
  $num_sets = 0;
  
  // insert a set for each field on screen
  for ($i = 0; $i < $num_sets; $i++) {
  
  }
  
  // add lift entry
  $statement = $connection->prepare(
      "INSERT INTO Lift (lift_id, workout_id, exercise) VALUES".
      	"(?, ?, ?);"
  );
  $statement->bind_param("iis", $r_id, $w_id, $_POST["exercise"]);
  $statement->execute();

} else {
  // TODO: Handle request without a search query
  echo "wtf (error in lift.php)";
}
 ?>
  </body>
</html>
<?php

// close the database connection
$connection->close();
