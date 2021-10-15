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
	<title>Edit your chosen book</title>
</head>
<body>
<?php
	//Draws the header and navigation bar of the site
	echo makeHeader();

	//Checks whether the user is logged in or not
	if(check_login()){
		//A try to catch errors if the database cannot be connected to
		try {
			//Draws the logout form
			echo makeLogoutForm();

			//Establising a connection to the database 
			$dbConn = getConnection();
			
			//Setting up the Category and Publisher dropdowns for the form
			$sqlCat = "SELECT * FROM NBL_category";
			$sqlPub = "SELECT * FROM NBL_publisher";

			//Preparing the statements to protect against SQL Injections
			$prepCat = $dbConn->prepare($sqlCat);
			$prepPub = $dbConn->prepare($sqlPub);

			//Executing the statements once prepared
			$prepCat->execute();
			$prepPub->execute();

			//Grabbing the book's ISBN from the choose book selection
			$bookISBN = $_GET['bookISBN'];

			//Setting up the query to collect the information based off of what book the user chose
			$sqlQuerybookID = 	"SELECT bookISBN,
										bookTitle,
										bookYear, 
										pubID,
										catID,
										bookPrice
								FROM NBL_books
								WHERE bookISBN = '$bookISBN'
								";

			//Stores the result of the query in a variable							
			$queryResultbookID=$dbConn->query($sqlQuerybookID);

			//Fetches the object from the result
			$rowObj=$queryResultbookID->fetchObject();

			//Uses the bookISBN taken the url to get the correct information
			$bookISBN = $dbConn->quote($bookISBN);
		}
		catch(\Exception $e){
			echo "Query error".$e->getMessage();
		}
		//Displays the edit book form for the user to edit
	  	echo "
			<div class='container'>
		  		<h1>You have chosen to edit: {$rowObj->bookTitle}</h1>
				<form id='editBooks' action='editBooksProcess.php' method='get'>
			    	<label>Book ID <input type='text' name='bookISBN' value='{$rowObj->bookISBN}' readonly></label><br>
			    	<label>Book Title <input type='text' name='bookTitle' value='{$rowObj->bookTitle}'></label><br>
			    	<label>Book Year <input type='number' name='bookYear' value='{$rowObj->bookYear}'></label><br>
					<label>Book Price(£) <input type='text' name='bookPrice' value='{$rowObj->bookPrice}'></label><br>
					<label>Publisher</label>

					<select name='pubID'>";

		//Break between the form in order to produce dynamic options for publisher and category dropdowns =================================================

		//A while loop in order to dynamically produces a dropdown menu for the publisher and display the name instead of the ID
		while($pub = $prepPub->fetchObject()){
			if($pub->pubID === $rowObj->pubID){
				$selected = "selected";
			}
			else{
				$selected = "";
			}
			echo "
					<option value='{$pub->pubID}' $selected>{$pub->pubName}</option>";
		}
		echo "
					</select><br>
					<label>Category</label>
					<select name='catID'>";

		//A while loop in order to dynamically produces a dropdown menu for the category and display the name instead of the ID		
		while($cat = $prepCat->fetchObject()){
			if($cat->catID === $rowObj->catID){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "
					<option value='{$cat->catID}'>{$cat->catDesc}</option>";
		}
		//Continuing the bottom of the form ===============================================================================================================
	    echo "
	    			</select><br>
					<input type='submit' value='Update Record'>
				</form>
			</div>";
	}//End of very long check_login If statement
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
