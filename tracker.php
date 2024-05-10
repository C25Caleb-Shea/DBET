<?php
session_start();
if (! isset($_SESSION["username"])) {
  header("Location: index.php?redirect=".$_SERVER["PHP_SELF"]);
}

$username = "student";
$password = "CompSci364";
$database = "student";

// connect to database
$connection = new mysqli("localhost", $username, $password,
                         $database);
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

    <h1>Tracker</h1>

    <a href="logout.php" class="logout">LOGOUT</a>
    <br><br>
    <a href="delete.php" class="delete">CLEAR DATA</a>
    <br><br>
    
    <img src="arnold.jpg"/> <!-- place holder image/ graph for user's progress-->

    <p>Biometrics</p>

    <table class="biometrics">
      <tr>
        <th>Name</th>
        <th>Height</th>
        <th>Weight</th>
        <th>DOB</th>
        <th>Gender</th>
      </tr>
<?php
  // query database to find entries that match the search string
  $statement = $connection->prepare(
      "SELECT first_name, height, weight, dob, gender ".
      "FROM User ".
      "WHERE first_name = ?; "
  );
  // use a prepared statement to prevent SQL injection attacks
  $statement->bind_param("s", $_SESSION["username"]);
  $statement->execute();  // execute query

  // bind values of attributes in the database to PHP variables
  $statement->bind_result($first_name, $height, $weight, $dob, $gender);
  $statement->fetch();


  // create a table row to display each result
 ?>
      <tr>
        <td><?php echo htmlspecialchars($first_name); ?></td>
        <td><?php echo htmlspecialchars($height); ?></td>
        <td><?php echo htmlspecialchars($weight); ?></td>
        <td><?php echo htmlspecialchars($dob); ?></td>
        <td><?php echo htmlspecialchars($gender); ?></td>
      </tr>
    </table>
    <br><br>

    <p>Lift PRs</p>
    <table class="metrics">
      <tr>
        <th>Lift</th>
        <th>Weight</th>
        <th>Reps</th>
        <th>Date</th>
      </tr>

<?php

  // reset for next query
  $statement->close();
  $connection->next_result();
  
  // query database to find entries that match the search string
  $statement = $connection->prepare(
      "SELECT a.exercise, a.weight, a.reps, a.ts ".
      "FROM (SELECT * FROM LSet NATURAL JOIN Lift NATURAL JOIN Workout) a ".
        "LEFT OUTER JOIN (SELECT * FROM LSet NATURAL JOIN Lift NATURAL JOIN Workout) b ".
        "ON a.exercise = b.exercise AND a.weight < b.weight ".
      "WHERE b.user_id IS NULL ".
      "ORDER BY a.ts DESC; "
  );
  //$statement->bind_param("s", $_SESSION["username"]);
  $statement->execute();  // execute query

  // bind values of attributes in the database to PHP variables
  $statement->bind_result($exercise, $weight, $reps, $ts);
  
  // create a table row to display each result
  while ($statement->fetch()) {
 ?>
      <tr>
        <td><?php echo htmlspecialchars($exercise); ?></td>
        <td><?php echo htmlspecialchars($weight); ?></td>
        <td><?php echo htmlspecialchars($reps); ?></td>
        <td><?php echo htmlspecialchars($ts); ?></td>
      </tr>

<?php
  }
?>
    </table>
    <br><br>
    
    <p>Recent Runs</p>
    <table class="metrics">
      <tr>
        <th>Length (miles)</th>
        <th>Date</th>
        <th>Type</th>
        <th>Length (time)</th>
      </tr>
      
      <?php

  // reset for next query
  $statement->close();
  $connection->next_result();
  
  // query database to find entries that match the search string
  $statement = $connection->prepare(
      "SELECT miles, ts, type, time_elapsed ".
      "FROM Run NATURAL JOIN Workout ".
      "ORDER BY ts ".
      "LIMIT 5;"
  );
  //$statement->bind_param("s", $_SESSION["username"]);
  $statement->execute();  // execute query

  // bind values of attributes in the database to PHP variables
  $statement->bind_result($miles, $ts, $type, $time_elapsed);
  
  // create a table row to display each result
  while ($statement->fetch()) {
 ?>
      <tr>
        <td><?php echo htmlspecialchars($miles); ?></td>
        <td><?php echo htmlspecialchars($ts); ?></td>
        <td><?php echo htmlspecialchars($type); ?></td>
        <td><?php echo htmlspecialchars($time_elapsed); ?></td>
      </tr>

<?php
  }
?>
  </table>
  <br><br>
  
  <p>Recent Swims</p>
    <table class="metrics">
      <tr>
        <th>Length (miles)</th>
        <th>Date</th>
        <th>Reps</th>
        <th>Duration</th>
      </tr>
      
      <?php

  // reset for next query
  $statement->close();
  $connection->next_result();
  
  // query database to find entries that match the search string
  $statement = $connection->prepare(
      "SELECT meters, ts, reps, time_elapsed ".
      "FROM Swim NATURAL JOIN Workout ".
      "ORDER BY ts ".
      "LIMIT 5;"
  );
  $statement->execute();  // execute query

  // bind values of attributes in the database to PHP variables
  $statement->bind_result($meters, $ts, $reps, $time_elapsed);
  
  // create a table row to display each result
  while ($statement->fetch()) {
 ?>
      <tr>
        <td><?php echo htmlspecialchars($meters); ?></td>
        <td><?php echo htmlspecialchars($ts); ?></td>
        <td><?php echo htmlspecialchars($reps); ?></td>
        <td><?php echo htmlspecialchars($time_elapsed); ?></td>
      </tr>

<?php
  }
?>
  </table>

  </center></body>
</html>

<?php
// close the database connection
$connection->close();
