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
    $_SESSION = array();
    session_destroy();
    header("location:loginForm.html")

     ?>
  </body>
</html>
