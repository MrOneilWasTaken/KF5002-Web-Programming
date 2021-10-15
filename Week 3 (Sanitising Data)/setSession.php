<?php
ini_set("session.save_path","/home/unn_w18018623/sessionData");
session_start();
$_SESSION['firstname'] ='Sam';
echo $_SESSION['firstname']." has set the session";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>

  <?php
  echo "<p>";
  ?>

</body>
</html>
