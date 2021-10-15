<?php
  function getConnection() {
    try {
      $connection = new PDO("mysql:host=localhost;dbname=unn_w18018623","unn_w18018623", "Sponge123");
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	     return $connection;
     }
     catch (Exception $e) {
       throw new Exception("Connection error ". $e->getMessage(), 0, $e);
     }
  }

  function validate_form() { 
  	$input = array(); 	// Create array for the form input
  	$errors = array(); // Create an empty array to hold error messages

  	/* Retrieve variables and store in array, then trim and store the 	modified value, e.g., */
    $input['productName'] = filter_has_var(INPUT_GET, 'productName') ? $_GET['productName'] : null;
    $input['productName'] = trim($input['productName']);
    $input['productName'] = filter_var($input['productName'], FILTER_SANITIZE_STRING);
		$input['productName'] = filter_var($input['productName'], FILTER_SANITIZE_SPECIAL_CHARS);

    $input['description'] = filter_has_var(INPUT_GET, 'description') ? $_GET['description'] : null;
    $input['description'] = trim($input['description']);
		$input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING);
		$input['description'] = filter_var($input['description'], FILTER_SANITIZE_SPECIAL_CHARS);

    $input['price'] = filter_has_var(INPUT_GET, 'price') ? $_GET['price'] : null;
    $input['price'] = trim($input['price']);
		$input['price'] = filter_var($input['price'], FILTER_SANITIZE_STRING);
		$input['price'] = filter_var($input['price'], FILTER_SANITIZE_SPECIAL_CHARS);

  	$input['categoryID'] = filter_has_var(INPUT_GET, 'categoryID') ? $_GET['categoryID'] : null;
    $input['categoryID'] = trim($input['categoryID']);


    // Making validation  for categoryID
    $catArray = array('c1','c2','c3');

    if(!in_array($input['categoryID'], $catArray)){
			$errors[] = "Enter a valid category ID";
		}

    // Check if use has entered empty
    if (empty($productName)){
			$errors[] = "Enter a product name";
		}

    if(empty($description)){
      $errors[] = "Enter a description";
    }

    if(empty($categoryID)){
      $errors[] = "Enter a cateory ID";
    }

    if(empty($price)){
      $errors[] = "Enter a price";
    }

    // Checking string length
    if(strlen($productName)>=50){
			$errors[] = "Enter a product name with less than 50 characters";
		}

    if(strlen($description)>=150){
			$errors[] = "Enter a product name with less than 150 characters";
		}

    if(strlen($price)>=10){
			$errors[] = "Enter a price with less than 10 characters";
		}

    // Check price is a decimal
    // if (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
    //   $errors[] = "Price must be a decimal number";
    // }

  		// Return an array of the input and errors arrays
  		return array ($input, $errors);
  }

  function show_errors(array $errors){
    foreach($errors as $item){
      $output="";
      $output.= "$item <br>";
      return $output;
    }
  }

  function process_form(array $input){
    $dbConn = getConnection();

    $sqlInsert = "INSERT INTO product (userID,
                                      productName,
                                      description,
                                      prices,
                                      categoryID)
									VALUES (:productName,
                          :description,
                          :categoryID,
                          :price)";

		$statement = $dbConn->prepare($sqlInsert);
		$statement->execute(array(
			':productName' => $productName,
			':description' => $description,
			':categoryID' => $categoryID,
			':price' => $price
		));

    echo "<h1>Product details</h1>\n";
		echo "<p>Name: $productName</p>\n";
		echo "<p>Description: $description</p>\n";
		echo "<p>Category: $categoryID</p>\n";
		echo "<p>Price: $price</p>\n";
  }


  //
  // function set_session($key, $value) {
  //  // Set key element = value
  //  $_SESSION[$key] = $value;
  //  return true;
  // }
  //
  // function get_session($key){
  //   if(isset($_SESSION[$key])){
  //     return $_SESSION[$key];
  //   }else{
  //     return false;
  //   }
  // }
  //
  //   function check_login(){
  //     if (get_session("logged-in")) {
  //       // code...
  //       return true;
  //     }else{
  //       return false;
  //     }
  //   }
  //



?>
