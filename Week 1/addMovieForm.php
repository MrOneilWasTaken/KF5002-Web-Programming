<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>
  <?php
  require_once("functions.php");
  $dbConn = getConnection();

  $sqlCat = "SELECT * FROM nc_category";
  $sqlDir = "SELECT * FROM nc_director";

  $queryCat = $dbConn->query($sqlCat);
  $queryDir = $dbConn->query($sqlDir);
   ?>




  <h1>Add movie</h1>
  <form id="addMovieProcess" action="addMovieProcess.php" method="get">
  	Title <input type="text" name="title">
  	<br>
  	Category
  	<select name="categoryID">

      <?php
        while ($cat = $queryCat->fetchObject()) {
          // code...
       echo "<option value='{$cat->categoryID}'>{$cat->categoryName}</option>";
     }
       ?>
  	</select>
  	<br>
  	Director
  	<select name="directorID">

      <?php
      while ($dir = $queryDir->fetchObject()) {
        // code...
        echo "<option value='{$dir->directorID}'>{$dir->directorName}</option>";
      }
       ?>

  	</select>
  	<br>
  	Description <br>
  	<textarea name="notes"></textarea>
  	<br>
      <input type="submit" value="Add movie">
  </form>


</body>

</html>
