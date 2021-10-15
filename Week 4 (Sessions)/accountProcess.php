<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    function show_errors(array $errors){
      foreach($errors as $item){
        $output="";
        $output.= "$item <br>";
        return $output;
      }
    }
    function validate_form(){
      $input = array();
      $errors = array();

      $input['firstName'] = filter_has_var(INPUT_POST, "firstName") ? $_POST['firstName'] : null;
      $input['firstName'] = trim($input['firstName']);
      $input['firstName'] = filter_var($input['firstName'], FILTER_SANITIZE_SPECIAL_CHARS);
      $input['firstName'] = filter_var($input['firstName'], FILTER_SANITIZE_STRING);

      $input['lastName'] = filter_has_var(INPUT_POST, "lastName") ? $_POST['lastName'] : null;
      $input['lastName'] = trim($input['lastName']);
      $input['lastName'] = filter_var($input['lastName'], FILTER_SANITIZE_SPECIAL_CHARS);
      $input['lastName'] = filter_var($input['lastName'], FILTER_SANITIZE_STRING);

      $input['userName'] = filter_has_var(INPUT_POST, "userName") ? $_POST['userName'] : null;
      $input['userName'] = trim($input['userName']);
      $input['userName'] = filter_var($input['userName'], FILTER_SANITIZE_SPECIAL_CHARS);
      $input['userName'] = filter_var($input['userName'], FILTER_SANITIZE_STRING);

      $input['passWord'] = filter_has_var(INPUT_POST, "passWord") ? $_POST['passWord'] : null;
      $input['passWord'] = trim($input['passWord']);

      $input['conpassWord'] = filter_has_var(INPUT_POST, "conpassWord") ? $_POST['conpassWord'] : null;
      $input['conpassWord'] = trim($input['conpassWord']);

      if (empty($input['firstName'])){
        $errors[] = "Enter a first name";
      }
      if (empty($input['lastName'])){
        $errors[] = "Enter a last name";
      }
      if (empty($input['userName'])){
        $errors[] = "Enter a user name";
      }
      if (empty($input['passWord'])){
        $errors[] = "Enter a password";
      }
      if (empty($input['conpassWord'])){
        $errors[] = "Confirm your password";
      }

      if(strlen($input['firstName'])>=50){
        $errors[] = "first name Too long";
      }
      if(strlen($input['lastName'])>=50){
        $errors[] = "last name Too long";
      }
      if(strlen($input['userName'])>=50){
        $errors[] = "username too long";
      }elseif(strlen($input['userName'])<6){
        $errors[] = "Username too short";
      }

      //============

      if(strlen($input['passWord'])<=8){
        $errors[] = "Too short";
      }

      if ($input['passWord'] != $input['conpassWord']){
        $errors[] = "Too short";
      }

      try {
        require_once("functions.php");
        $dbConn = getConnection();

        $temp = "SELECT username FROM users WHERE username = :username";

        $temp2 = $dbConn->prepare($temp);
        $temp2->execute(array(":username" => $input['userName']));
        $temp3 = $temp2->fetchObject();

        if ($temp3) {
          $errors[] = "Username exists, please retry";
        }



      } catch (Exception $e) {
        echo "Query error".$e->getMessage();
      }
      return array($input,$errors);
    }

    function process_form(array $input){
      try {
        require_once("functions.php");
        $dbConn = getConnection();

        $passwordHash = password_hash($input['passWord'],PASSWORD_DEFAULT);

        $temp4 = "INSERT INTO users (firstname, surname, username, passwordHash)
                  VALUES(:firstname,:lastname,:username,:passwordHash)";
        $statement = $dbConn->prepare($temp4);
        $statement->execute(array(
          ':firstname' => $input['firstName'],
          ':lastname' => $input['lastName'],
          ':username' => $input['userName'],
          ':passwordHash' => $passwordHash));

          echo "Account successfully created";
          header("location:loginForm.html");



      } catch (Exception $e) {
        echo "Query error with insertion".$e->getMessage();
      }

    }

    list($input, $errors) = validate_form();
      if ($errors) {
      	echo show_errors($errors);
        echo "<form class='' action='accountProcess.php' method='post'>
          Firstname <input type='text' name='firstName' value='".$input['firstName']."'<br>
          Last name<input type='text' name='lastName' value='".$input['lastName']."'><br>
          Username <input type='text' name='userName' value='".$input['userName']."'><br>
          Password <input type='password' name='passWord' value='".$input['passWord']."'><br>
          Confirm Password <input type='password' name='conpassWord' value='".$input['conpassWord']."'><br>
          <input type='submit' name='' value='Register'>
        </form>";
      }
    else {
      echo process_form($input);
    }



     ?>

  </body>
</html>
