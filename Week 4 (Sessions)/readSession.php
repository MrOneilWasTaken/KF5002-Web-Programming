<?php
ini_set("session.save_path","/home/unn_w18018623/sessionData");
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    if(isset($_SESSION['firstname'])){
      $firstname = $_SESSION['firstname'];
      echo "<p>Username: $firstname</p>\n";
    }
     ?>
     <form method="post" action="loginProcess.php">
       Username <input type="text" name="username">
		   Password <input type="password" name="password">
       <input type="submit" value="Logon">
     </form>

  </body>
</html>
