<?php
function getConnection() {
try {
$connection = new PDO("mysql:host=localhost;dbname=unn_w18018681",
  "unn_w18018681", "newnumyspace");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $connection;
} catch (Exception $e) {
throw new Exception("Connection error ". $e->getMessage(), 0, $e);
}
}

function set_session($key, $value) {
// Set key element = value
	$_SESSION[$key] = $value;
return true;
}

function getSession($key){
	if (isset($_SESSION[$key])){
		return $_SESSION[$key];
	}
	
	else {
		return false; 
	}	
}

function check_login(){
	if (getSession("loggedIn")){
		return true;
	}	
	else{
		return false; 
	}	
}

function makePageStart() {
	$pageStartContent = <<<PAGESTART
	<!doctype html>
	<html lang="en">
	<head>
	<meta charset="UTF-8">
		<title>Review it!</title>
		<link href="review.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="gridContainer">
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
}

function makeHeader(){
	$headContent = <<<HEAD
	<header>
		<h1>Review it!</h1>
	</header>
HEAD;
	$headContent .="\n";
	return $headContent;
}

function makeNavMenu($navMenuHeader) {
	$navMenuContent = <<<NAVMENU
	<nav>
		<h2>$navMenuHeader</h2>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="books.php">Books</a></li>
		<li><a href="dvd.php">DVD</a></li>
		<li><a href="games.php">Games</a></li>
	</ul>
	</nav>
NAVMENU;
	$navMenuContent .= "\n";
	return $navMenuContent;
}

function makeMainArea() {
	$mainContent = <<<MAINAREA
	<main>
		<h2>Add your reviews of the following and more</h2>
		<h3>Jamie's America</h3>
		<p>Jamie will try real American food and meet the most
interesting cooks and producers that this vast country has
to
offer. His epic journey will take him to the heart of
America:
its people, culture, music and, most importantly, its food.
As
well as being a visually stunning journey, "Jamie's
America"
is a practical cookbook, with each chapter focusing on the
food and recipes of a different state. Add review</p>

	</main>
MAINAREA;
	$mainContent .= "\n";
	return $mainContent;
}

function makeFooter() {
	$footContent = <<<FOOT
	<footer>
	<p>Product details taken from the whsmith web site</p>
	</footer>
FOOT;
	$footContent .="\n";
	return $footContent;
}

function makePageEnd() {
	return "</div>\n</body>\n</html>";
}
?>
