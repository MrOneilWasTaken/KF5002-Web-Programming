<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>
  <?php

  require_once("functions.php");
  $dbConn = getConnection();

  $movieID = filter_has_var(INPUT_GET, 'movieID')		? $_GET['movieID'] : null;
  $title = filter_has_var(INPUT_GET, 'title')		? $_GET['title'] : null;
  $categoryID = filter_has_var(INPUT_GET, 'categoryID')		? $_GET['categoryID'] : null;
  $directorID = filter_has_var(INPUT_GET, 'directorID')		? $_GET['directorID'] : null;
  $notes = filter_has_var(INPUT_GET, 'notes')		? $_GET['notes'] : null;

  if (empty($movieID)) {
    echo "<p>You have not entered a Movie ID</p>\n";
  }
  if (empty($title)) {
    echo "<p>You have not entered a title</p>\n";
  }
  if (empty($categoryID)) {
    echo "<p>You have not entered a Category ID</p>\n";
  }
  if (empty($directorID)) {
    echo "<p>You have not entered a Director ID</p>\n";
  }
  if (empty($notes)) {
    echo "<p>You have not entered notes</p>\n";
  }


  $movieID = $dbConn->quote($movieID);
  $title = $dbConn->quote($title);
  $categoryID = $dbConn->quote($categoryID);
  $directorID = $dbConn->quote($directorID);
  $notes = $dbConn->quote($notes);

  $sqlUpdate = "UPDATE nc_movie
                SET title = $title,
                    categoryID = $categoryID,
                    directorID = $directorID,
                    notes = $notes
                WHERE movieID = $movieID";
  $dbConn->query($sqlUpdate);

?>

<h1>Update completed without error</h1>
<a href="chooseMovieList.php">Return to Database</a>

</body>

</html>
