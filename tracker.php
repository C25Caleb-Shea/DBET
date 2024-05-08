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
        <th>PR</th>
        <th>Date</th>
      </tr>

<?php

  // reset for next query
  $statement->close();
  $connection->next_result();
  
  // query database to find entries that match the search string
  $statement = $connection->prepare(
      "SELECT exercise, max(weight), ts ".
      "FROM LSet NATURAL JOIN Lift NATURAL JOIN Workout ".
      "WHERE user_id = 1 ".
      "GROUP BY exercise, ts ".
      "ORDER BY ts; "
  );
  // use a prepared statement to prevent SQL injection attacks
  //$statement->bind_param("s", "1");
  $statement->execute();  // execute query

  // bind values of attributes in the database to PHP variables
  $statement->bind_result($exercise, $weight, $ts);
  
  // create a table row to display each result
  while ($statement->fetch()) {
 ?>
      <tr>
        <td><?php echo htmlspecialchars($exercise); ?></td>
        <td><?php echo htmlspecialchars($weight); ?></td>
        <td><?php echo htmlspecialchars($ts); ?></td>
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
