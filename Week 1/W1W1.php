<!doctype html>
<html lang="en">

	<!-- -->
	<!-- 		Head Text		-->
	<!-- -->

	<head>
		<meta charset="utf-8">
	</head>

	<!-- -->
	<!-- 		Body Text		-->
	<!-- -->

	<body>
		<?php
		try {
			require_once("functions.php");
			$dbConn = getConnection();

			$sqlQuery = "SELECT title, categoryName, directorName
			FROM nc_movie
			INNER JOIN nc_category
			ON nc_category.categoryID = nc_movie.categoryID
			INNER JOIN nc_director
			ON nc_director.directorID = nc_movie.directorID
			ORDER BY title";
			$queryResult = $dbConn->query($sqlQuery);

			while ($rowObj = $queryResult->fetchObject()) {
				echo "<div class='movie'>\n
				<span class='title'>{$rowObj->title}</span>\n
				<span class='categoryName'>{$rowObj->categoryName}</span>\n
				<span class='directorName'>{$rowObj->directorName}</span>\n
				</div>\n";
			}
		}
		catch (Exception $e){
			echo "<p>Query failed: ".$e->getMessage()."</p>\n";
		}
		?>

	</body>

</html>
