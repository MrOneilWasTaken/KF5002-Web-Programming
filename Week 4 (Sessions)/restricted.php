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
      require_once("functions.php");
      $dbConn = getConnection();

      if(check_login()){
        echo "<p>Welcome! This page could now display information / provide functionality that you want to restrict access to</p>\n
              <a href='logOut.php'>Click here to log out.</a>";
      }else{
        echo "<h1>You have tried to access a restricted page.</h1>
              <p>Please log in to access this page<p>
              <a href='loginForm.html'>Back to Log in page</a>";
      }


     ?>
  </body>
</html> 
