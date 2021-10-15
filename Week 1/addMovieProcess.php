<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
		try {
			require_once("functions.php");
			$dbConn = getConnection();

      $movieTitle = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
      $movieCategory = isset($_REQUEST['categoryID']) ? $_REQUEST['categoryID'] : null;
      $movieDirector = isset($_REQUEST['directorID']) ? $_REQUEST['directorID'] : null;
      $movieNotes = isset($_REQUEST['notes']) ? $_REQUEST['notes'] : null;

			$sqlInsert = "INSERT INTO nc_movie (title,
        directorID,
        categoryID,
        notes)
        VALUES ('$movieTitle',
                '$movieDirector',
                '$movieCategory',
                '$movieNotes')";

        $dbConn->query($sqlInsert);

			}

		catch (Exception $e){
			echo "<p>Query failed: ".$e->getMessage()."</p>\n";
		}
		?>
  </body>
</html>
