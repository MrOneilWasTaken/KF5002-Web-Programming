<?php
ini_set("session.save_path","/home/unn_w18018623/sessionData");
session_start();
$_SESSION['loggedin'] ='true'; 
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <a href="restricted.php">Restricted</a>
    <?php
    function validate_logon(){
      $input = array();
      $errors = array();

      $input['username'] = filter_has_var(INPUT_POST, 'username') ? $_POST['username']: null;
      $input['password'] = filter_has_var(INPUT_POST, 'password') ? $_POST['password']: null;

      require_once("functions.php");
      $dbConn = getConnection();
      $querySQL = "SELECT passwordHash FROM users WHERE username = :username";

      $stmt = $dbConn->prepare($querySQL);
      $stmt->execute(array(':username' => $input['username']));

      $user = $stmt->fetchObject();
      if ($user) {
      	$passwordHash = $user->passwordHash;
      // Add code to verify the password attempt here (see below)
        if (password_verify($input['password'],$passwordHash)) {
          header("location:restricted.php");
        }    else {
        $errors[] = "Username or password incorrect";
        }
      }else{
        $errors[] = "Username or password incorrect";
      }
    }

    list($input, $errors) = validate_logon();
    if ($errors) {
     	echo show_errors($errors);
    }
    else {
    set_session('logged-in', 'true');
    echo "<a href='restricted.php'>Restricted page</a>\n";
    }

    function show_errors(array $errors){
      foreach($errors as $item){
        $output="";
        $output.= "$item <br>";
        return $output;
      }
    }




     ?>
  </body>
</html>
