<?php
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
    <title>RUN.PHP!!!!!!!!!!!!!!!!!!!!!!</title>
  </head>
  <body>
<?php
if (isset($_POST["startTime"])) {  // search form submitted
  // create an HTML table to display the search results
 ?>

<?php
  // query database to find entries that match the search string
  $statement = $connection->prepare(
      "INSERT INTO Run (run_id, workout_id, miles, type, time_elapsed) VALUES".
      	"(12111, 12, ?, ?, '00:40:00');"
  );  // use a prepared statement to prevent SQL injection attacks
  $statement->bind_param("ss", $_POST["miles"], $_POST["reps"]);
  $statement->execute();  // execute query

} else {
  // TODO: Handle request without a search query
}
 ?>
  </body>
</html>
<?php

// close the database connection
$connection->close();
