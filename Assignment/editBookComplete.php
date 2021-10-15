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
	<title>Edit complete</title>
</head>
<body>
<?php
	//Draws the header and navigation bar of the site
	echo makeHeader();

	//Checks whether the user is logged in or not
	if(check_login()){

		//Draws the logout form
		echo makeLogoutForm();

		//A message to notify the user that their update has been completed
		echo "
		<div class='container'>
		<h1>Your edit has been completed.</h1>
		<h2><a href='chooseBookList.php'>Click here to return to choose another book.</a></h2>
		</div>";
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