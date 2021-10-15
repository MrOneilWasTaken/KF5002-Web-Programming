<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
    try {



      //Opening up a file to write into the database
      $fileHandle = fopen("students.csv","wb");

      require_once("functions.php");
      $dbConn = getConnection();

      $sqlQuery = "SELECT studentid, forename, surname, coursecode, stage, email
      FROM sts_student
      ";

      while ($row = $sqlQuery->fetch(PDO::FETCH_NUM)) {
        // code...
        fputcsv($fileHandle,$row);
        echo"<div>
            <span>{$row->studentid}</span>
            </div>";
      }
    } catch (\Exception $e) {
      echo "<p>There was an error, please try again</p>\n";
      log_error($e);
    }
     ?>

  </body>
</html>
