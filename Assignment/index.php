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
	<title>Home Page</title>
</head>
<body>
<?php
	//Draws the header and navigation bar of the site
	echo makeHeader();

	//Checks whether the user is logged in or not
	if(check_login()){
		//Draws the logout form
		echo makeLogoutForm();
	}
	else{
		//Draws the login form
		echo makeLogonForm();
	}
	//Displays errors if there are any
	echo makeLogonErrorResults();
?>
	
	<div class="container">
		<h2>Welcome to the index page for Northumbria Books</h2>

		<h2>HTML Offers</h2>
		<aside id="offers">	
			<!-- Content brought from getOffers.php -->
		</aside>

		<h2>JSON Offers</h2>
		<aside id="JSONoffers">
			<!-- Content brought from getOffers.php -->
		</aside>
	</div>

	<script type="text/javascript" src="jsonTask.js">
		//Calls the Javascript from jsonTask.js
	</script>

</body>
</html>