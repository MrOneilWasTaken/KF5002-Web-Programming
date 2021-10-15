<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>
  <?php
  try {
  require_once("functions.php");
  $dbConn = getConnection();

  $sqlQuery = "SELECT moviID, title, categoryName, directorName
  		FROM nc_movie
  		INNER JOIN nc_category
  		ON nc_category.categoryID = nc_movie.categoryID
  		INNER JOIN nc_director
  		ON nc_director.directorID = nc_movie.directorID
  		ORDER BY title";
  $queryResult = $dbConn->query($sqlQuery);

  while ($rowObj = $queryResult->fetchObject()) {
  	echo "<div class='movie'>\n
  	<span class='title'><a href='editMovieForm.php?movieID={$rowObj->movieID}'>{$rowObj->title}</a></span>\n
  	<span class='categoryName'>{$rowObj->categoryName}</span>\n
  	<span class='directorName'>{$rowObj->directorName}</span>\n
  	</div>\n";
  }
  }
  catch (Exception $e){
  echo "<p>There was an error, please try again</p>\n";
  log_error($e);
  }
?>



</body>

</html>
