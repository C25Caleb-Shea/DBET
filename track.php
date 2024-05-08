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
    ...
  </head>
  <body>
<?php
  // create an HTML table to display the search results
 ?>
    <h4>Biometrics</h4>
    <table>
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
  $statement->bind_param("s", $_POST["fname"]);
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
  </body>
</html>
<?php

// close the database connection
$connection->close();
