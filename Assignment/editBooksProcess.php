<?php
  //Starting the session if it hasn't already been started and settings the correct path
  ini_set("session.save_path", "/home/unn_w18018623/sessionData");
  session_start();
  require_once("functions.php");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <title>Loading...</title>
</head>
<body>
<?php
  	if(check_login()){
      //Checks whether the user is logged in or not
  		echo makeLogoutForm();
  		//Connecting to the database in order to push through the 
  		$dbConn = getConnection();

      //Validates the edit details the user inputs and stores them in a list
  		list($input, $errors) = validate_editForm();
      
      //If there are errors
  		if ($errors) {
        //Displays the errors the validation caught
    		echo "An error has occurred: ".show_errors($errors);
  		}
      //If there were no errors detected
  		else{
        //Send the user to a completion screen
    		header("Location: editBookComplete.php");
  		}	
  	}
    else{
    //Draws a logon form
    echo makeLogonForm();

    //Draws a box notifying the user they have tried to access a restricted page
    echo makeLogonError();
  }
  //Displays errors if there are any
  echo makeLogonErrorResults();
?>
</body>
</html>
