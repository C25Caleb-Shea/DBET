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
    <title>LIFT.PHP!!!!!!!!!!!!!!!!!!!!!!</title>
  </head>
  <body>
<?php
if (isset($_POST["startTime"])) {  // search form submitted
  // create an HTML table to display the search results
 ?>
    <h4>Search Results</h4>
    <table>
      <tr>  <!-- header -->
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Related</th>
      </tr>  <!-- end header -->
<?php
  // query database to find entries that match the search string
  $statement = $connection->prepare(
      "SELECT id, name, description, relatedId ".
      "FROM Example ".
      "WHERE name LIKE ?;"
  );  // use a prepared statement to prevent SQL injection attacks
  $statement->bind_param("s", $_POST["q"]);  // bind user input to `?`
  $statement->execute();  // execute query

  // bind values of attributes in the database to PHP variables
  $statement->bind_result($id, $name, $description, $relatedId);
  // iterate over results
  while ($statement->fetch()) {
    // create a table row to display each result
 ?>
      <tr>
        <td><?php echo htmlspecialchars($id); ?></td>
        <td><?php echo htmlspecialchars($name); ?></td>
        <td><?php echo htmlspecialchars($description); ?></td>
        <td><?php echo htmlspecialchars($relatedId); ?></td>
      </tr>
<?php
  }  // end while
 ?>
    </table>
<?php
} else {
  // TODO: Handle request without a search query
}
 ?>
  </body>
</html>
<?php

// close the database connection
$connection->close();
