<?php
	//Starting the session if it hasn't already been started and settings the correct path
	ini_set("session.save_path","/home/unn_w18018623/sessionData");
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
		
		//Validates the login details the user inputs and stores them in a list
		list($input, $errors) = validate_logon();

		//If there are errors
		if($errors){
			//Collect the errors the validation caught and store them in a session
			set_session("loginErrors",show_errors($errors));
			//Return the user to the page they attempted to log in
			header('location:'.$_SERVER['HTTP_REFERER']);
		}
		//If there were no errors detected
		else{
			//Remember the user has used correct credentials and store that in a session
			set_session('logged-in','true');
			//Collected errors (0) stored in a session just in case
			set_session('loginErrors','');
			//Return the user to the page they attempted to log in
			header('location:'.$_SERVER['HTTP_REFERER']);
		}
	 ?> 
</body>
</html>