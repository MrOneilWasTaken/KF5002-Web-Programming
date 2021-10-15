<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>
  <?php

  require_once("functions.php");
  $dbConn = getConnection();

  $movieTitle = $_GET['movieID'];

  $sqlQueryTitle = "SELECT movieID,
                    title,
                    directorID,
                    categoryID,
                    notes
                    FROM nc_movie
                    WHERE movieID='$movieTitle'
                    ";
  $queryResultTitle=$dbConn->query($sqlQueryTitle);
  $titleRowObj=$queryResultTitle->fetchObject();
    $movieTitle = $dbConn->quote($movieTitle);
  echo "<h1>Update '{$titleRowObj->title}'</h1>
        <form id='UpdateMovie' action='updateMovie.php' method='get'>
        <label>Movie ID<input type='text' name='movieID' value='{$titleRowObj->movieID}' readonly></label>
        <br>
        <label>Title<input type='text' name='title' value='{$titleRowObj->title}'></label>
        <br>
        <label>Category ID<input type='number' name='categoryID' value='{$titleRowObj->categoryID}'></label>
        <br>
        <label>Director ID<input type='number' name='directorID' value='{$titleRowObj->directorID}'></label>
        <br>
        <label>Notes<input type='text' name='notes' value='{$titleRowObj->notes}'></label>
        <input type='submit' value='update'>
        ";




   ?>

</body>

</html>
