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
	<title>Credits</title>
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
		<h1>Credits</h1>
	</div>

	<div class="container">
		<h3>Name: Sam Oneil</h3>
		<h3>Student ID: w18018623</h3>
	</div>

	<div class="container">
		<h3>Corso, D., 2018. What Is The Queryselector Method In Javascript? | Document.Queryselector() Explained. [online] YouTube.com. Available at: <a href="https://youtu.be/3oOKAJTD2F8">https://youtu.be/3oOKAJTD2F8</a> [Accessed 20 December 2020].</h3>
		<iframe width="947" height="542" src="https://www.youtube.com/embed/3oOKAJTD2F8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>

	<div class="container">
		<h3>Corso, D., 2018. What is the querySelectorAll method in JavaScript? | Document.querySelectorAll() Explained. [online] YouTube.com. Available at: <a href="https://youtu.be/D7sNpAiNMQM">https://youtu.be/D7sNpAiNMQM</a> [Accessed 20 December 2020].</h3>
		<iframe width="947" height="542" src="https://www.youtube.com/embed/D7sNpAiNMQM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>

	<div class="container">
		<h3>James, J., 2015. HTML: How to Create FORMS and Get Field Data with PHP [online] YouTube.com. Available at: <a href="https://youtu.be/qUW6GAK6CBA">https://youtu.be/qUW6GAK6CBA</a> [Accessed 21 December 2020].</h3>
		<iframe width="941" height="539" src="https://www.youtube.com/embed/qUW6GAK6CBA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>

	<div class="container">
		<h3>Elvin, G., 2020. How To Reminders [online] elp.northumbria.ac.uk. Available at: <a href="https://learn-eu-central-1-prod-fleet01-xythos.content.blackboardcdn.com/5b6bce0407d12/10536018?X-Blackboard-Expiration=1609783200000&X-Blackboard-Signature=59C2t3fKVfMVFfOuVf4NZnc4K1jUXlWrg8u12osxCaM%3D&X-Blackboard-Client-Id=101072&response-cache-control=private%2C%20max-age%3D21600&response-content-disposition=inline%3B%20filename%2A%3DUTF-8%27%27HowTo%252520reminders.pdf&response-content-type=application%2Fpdf&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Date=20210104T120000Z&X-Amz-SignedHeaders=host&X-Amz-Expires=21600&X-Amz-Credential=AKIAZH6WM4PL5M5HI5WH%2F20210104%2Feu-central-1%2Fs3%2Faws4_request&X-Amz-Signature=3485a7be13d5bbae181a65a1c4a3bcb29d638f88f0a11ea25a4e6e01eb2892b1">https://bit.ly/3nggLWe</a> [Accessed 4 November 2020].</h3>
		<p>Get connection function</p>
	</div>
	
</body>
</html>