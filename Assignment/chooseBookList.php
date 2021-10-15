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
	<title>Choose a Book</title>
</head>
<body>
<?php
	//Draws the header and navigation bar of the site
	echo makeHeader();

	//Checks whether the user is logged in or not
	if(check_login()){

		//A try to catch errors if the database cannot be connected to
		try{

			//Draws the logout form
	      	echo makeLogoutForm();

	      	//Connects to the database and stores it in a variable
	        $dbConn = getConnection();

	        //An SQL query saved to a variable searching for a book's
	        //Book ISBN, Book title, Book year, Book Price and Category description
	        $sqlQuery = "SELECT bookISBN,
	        bookTitle,
	        bookYear,
	        bookPrice,
	        catDesc
	        FROM NBL_books
	        INNER JOIN NBL_category
	        ON NBL_books.catID = NBL_category.catID
	        ORDER BY bookTitle
	        ";

	        //Executing the SQL query
        	$sqlQuery = $dbConn->query($sqlQuery);

        	//A header to ask the user what book they want to change
        	echo "<div class='container'><h1>Choose a book you would like to change</h1></div>";

        	//A while loop going though each object the query finds and displaying them for the user with the below HTML structure
        	while ($rowObj = $sqlQuery->fetchObject()) {
          		echo "
          			<div class='container'>
			            <span class=''>{$rowObj->bookISBN}</span><br>
			            <span class=''><a href='editBooks.php?bookISBN={$rowObj->bookISBN}'>{$rowObj->bookTitle}</a></span><br>
			            <span class=''>{$rowObj->bookYear}</span><br>
			            <span class=''>{$rowObj->catDesc}</span><br>
			            <span class=''>£{$rowObj->bookPrice}</span><br>
	          		</div>
	          	";
        	}//End of WHILE
      	}//End of TRY
      	catch(\Exception $e) {
      		//
        	echo "Query error".$e->getMessage();
     	}//End of CATCH
    }//End of Function
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