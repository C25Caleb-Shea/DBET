<?php
session_start();

// create database connection
$connection = new mysqli("localhost", "student", "CompSci364",
                         "student");

// attempt to validate the username/password
$error = false;
if (! isset($_SESSION["username"])
    && isset($_POST["username"], $_POST["password"])) {

  // query database for account information
  $statement = $connection->prepare("SELECT pw_h ".
                                    "FROM User ".
                                    "WHERE first_name = ?;");
  $statement->bind_param("s", $_POST["username"]);

  $statement->execute();
  $statement->bind_result($password_hash);

  // username present in database
  if ($statement->fetch()) {
  
    // verify that the password matches stored password hash
    if (password_verify($_POST["password"], $password_hash)) {
      
      // store the username to indicate authentication
      $_SESSION["username"] = $_POST["username"];
      
      $location = "tracker.php";
      if (isset($_REQUEST["redirect"])) {
        $location = $_REQUEST["redirect"];
      }

      // redirect to requested page
      header("Location: ".$location);
    }
  }

  $error = true;
}
?>

<!DOCTYPE html>

<!-- 
  C2Cs Miles Kirk and Caleb Shea

  Doc statement:
    When designing the CSS for the website we referenced:
      https://www.w3schools.com/cssref/css_selectors.php
        (to understand targeting of elements)
      https://www.w3schools.com/css/css_align.asp
        (to understand aligning text/divs)
      https://developer.mozilla.org/en-US/docs/Learn/CSS/Building_blocks/Styling_tables
        (to understand how to style a table)
      https://developer.mozilla.org/en-US/docs/Learn/CSS/Styling_text/Styling_links
        (to understand how to style links)
    When designing the JaveScript we referenced:
      https://developer.mozilla.org/en-US/docs/Web/API/Element/after
        (to understand how to place an element where we want)
      https://www.w3schools.com/tags/tag_button.asp
        (to understand how to create a button that doesn't submit a form)
      https://www.geeksforgeeks.org/how-to-change-the-text-of-a-label-using-javascript/#
        (to understand how to use innerHTML)
      https://stackoverflow.com/questions/13033074/javascript-checkbox-create-element
        (to understand how to set attributes of elements that are created via JS)
      We also referenced the "script.js" that came with the Web Development pex to
        understand how to create elememts and push them to a page.
 -->

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>SK Workout Tracker</title> 
  </head>

  <body><center>
    
    <h1 class="page_title">SK Ultimate Workout Tracker</h1>

    <img src="arnold.jpg"/>

    <p>Track all of your workouts here! From running to swimming to lifting! See your progress!</p>

    <h2>Sign In</h2>
    <?php
      if ($error) {
        echo "Invalid username or password.";
      }
    ?>
    <br><br>
    <form action="<?php echo $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"]; ?>" method="POST">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" pattern="[A-Za-z -]{1,50}" maxlength ="50" value="<?php if (isset($_POST["username"]))
                            echo $_POST["username"]; ?>" required><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" pattern="[A-Za-z -]{1,50}" maxlength ="50" required><br>

      <input type="submit" value="Log in">
    </form>

  </center></body>
</html>
