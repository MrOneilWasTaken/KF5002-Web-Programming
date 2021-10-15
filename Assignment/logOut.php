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
	//Destroys the session, making the user have to log in again if they want access to restricted pages
	session_destroy();
	//Sends the user back to where they pressed the link to log out
	header('location:'.$_SERVER['HTTP_REFERER']);
?>
</body>
</html>