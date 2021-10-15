<?php
//------------------------------------------------------------------------------
/*                           Functions for the Website                        */
//------------------------------------------------------------------------------

//Connection to the database
function getConnection() {
  try {
    $connection = new PDO("mysql:host=localhost;dbname=unn_w18018623","unn_w18018623", "Sponge123");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
  }
  //Spit out an error if the connection cannot be made
  catch(Exception $e) {
    throw new Exception("Connection error ". $e->getMessage(), 0, $e);
  }
}
//------------------------------------------------------------------------------

//Functions that provide HTML that can be called repeatedly (Modularity)

//Header and Footer HMTL generation
function makeHeader(){
  $headerContent = <<<HEADERCONTENT
  <div id="header">
    <h2>Northumbria Books</h2>
    <ul>
      <li><a href="credits.php">Credits</a></li>
      <li><a href="orderBooksForm.php">Order Books</a></li>
      <li><a href="chooseBookList.php">Choose a book to edit</a></li>
      <li><a href="index.php">Home Page</a></li>
    </ul>
  </div>
HEADERCONTENT;
  $headerContent .= "\n";
  return $headerContent;
}

//Log in box HTML generation
function makeLogonForm(){
  $logonContent = <<<LOGON
  <nav>
    <h2>Log in</h2>
    <form method="post" action="adminLogOnProcess.php">
        <label>Username</label>
        <input type="text" name="userName"><br>
        <label>Password</label>
        <input type="password" name="passWord"><br>
        <input type="submit" value="Log In">
    </form>
  </nav>
LOGON;
  $logonContent .="\n";
  return $logonContent; 
}

//Logout form HTML generation
function makeLogoutForm(){
  $logoutContent = <<<LOGOUT
  <nav>
    <h2><a href="logOut.php">Click here to log out</a></h2>
  </nav>
LOGOUT;
  $logoutContent .="\n";
  return $logoutContent; 
}

//Error for accessing restricted page generation
function makeLogonError(){
  $logonErrorContent = <<<LOGONERROR
  <div class="container">
   <h2>You have tried to access a restricted page</h2>
   <p>In order to see this page, please log in.</p>
  </div>
LOGONERROR;
  $logonErrorContent .="\n";
  return $logonErrorContent;
}

//Displays the error results from an incorrect login attempt
function makeLogonErrorResults(){
  if (get_session("loginErrors")){
    echo get_session("loginErrors");
  }
}

//----------------------------------------------------------------------------

//Functions for login system 

//Function to set a session variable easily
function set_session($key, $value) {
  $_SESSION[$key] = $value;
  return true;
}

//A quicker way to get a session
function get_session($key){
  if(isset($_SESSION[$key])){
    return $_SESSION[$key];
  }else{
    return false;
  }
}

//A check to see if the "logged-in" session variable exists
function check_login(){
  if (get_session("logged-in")) {
    return true;
  }else{
    return false;
  }
}
//----------------------------------------------------------------------------
/*

This next section of code validates both the login system as well as the
edit book form, triming the data provided by the user and preventing
SQL injections bt preparing queries provided by the user. This protects
the database as well as adding another layer of security to user's accounts
in terms of the login system.

*/
//----------------------------------------------------------------------------

//Validating the inputt3ed login details
function validate_logon(){
  //Establishing an array for inputs and errors
  $input = array();
  $errors = array();

  //Both the username and password the user inputted into the login form
  //Are taken and stored in the input array
  $input['userName'] = filter_has_var(INPUT_POST, 'userName') ? $_POST['userName']: null;
  $input['passWord'] = filter_has_var(INPUT_POST, 'passWord') ? $_POST['passWord']: null;

  //Checks if the username input it empty
  if(empty($input['userName'])){
    //Adds to the error array with a relevent message
    $errors[] = "Username has not been entered";
  }
  //Checks if the password input it empty
  if(empty($input['passWord'])){
    //Adds to the error array with a relevent message
    $errors[] = "Password has not been entered";
  }

  try{
    //Connects to the database and stores it in a variable
    $dbConn = getConnection();

    //Setting up an SQL query with a placeholder for the username
    $usernameSQL = "SELECT passwordHash
                    FROM NBL_users
                    WHERE username = :username";

    //Preparing the SQL to prevent SQL injections
    $prepUsernameSQL = $dbConn->prepare($usernameSQL);
    //Executing the SQL, replacing the placeholding with the username the user inputted in the login form
    $prepUsernameSQL->execute(array(':username' => $input['userName']));

    //Storing the username the user inputted into a variable
    $usernameSET = $input['userName'];

    //Storing the users encrypted password into a variable
    $user = $prepUsernameSQL->fetchObject();

    //If the user exists...
    if ($user) {
      //Decrypt the user's password and store it to be checked
      $passwordHash = $user->passwordHash;

      //If the user's inputted password matches the decrypted password...
      if(password_verify($input['passWord'], $passwordHash)){
        //Allow the user access to restricted areas
        set_session("logged-in",'true');
        //Remember the username that has logged in
        set_session("username", $usernameSET);
      }
      else{
        //Adds to the error array with a relevent message
        $errors[] = "Username or Password Incorrect";
      }
    }
    else{
      //Adds to the error array with a relevent message
      $errors[] = "Username or Password Incorrect";
    }
  } 
  catch (Exception $e) {
    echo "There was a problem: " . $e->getMessage();
  }
  //Output the inputs and errors the validation function collected
  return array($input, $errors);
}

//Validating information provided by editBooks.php
function validate_editForm(){
  $input = array();   // Create array for the form input
  $errors = array(); // Create an empty array to hold error messages

  //Check that variable exists, if it does, grab it. If not, dont do anything
  $input['bookISBN'] = filter_has_var(INPUT_GET, 'bookISBN') ? $_GET['bookISBN'] : null;
  $input['bookTitle'] = filter_has_var(INPUT_GET, 'bookTitle') ? $_GET['bookTitle'] : null;
  $input['bookYear'] = filter_has_var(INPUT_GET, 'bookYear') ? $_GET['bookYear'] : null;
  $input['pubID'] = filter_has_var(INPUT_GET, 'pubID') ? $_GET['pubID'] : null;
  $input['catID'] = filter_has_var(INPUT_GET, 'catID') ? $_GET['catID'] : null;
  $input['bookPrice'] = filter_has_var(INPUT_GET, 'bookPrice') ? $_GET['bookPrice'] : null;
 
  /*
  
  Could do a query to grab the Categories and Publishers from the DB so it isn't hardcoded.
  This is an improve that could be made in the future but, I don't see a reason to implement
  it at the current state of the website.
                            ----vvvvvvvvvvvvvvv----
  */
  
  //Setting up validations to only accept the arrays present in the database
  $catArray = array('PROG','SYSD','BUS','WEBDEV','DB','DBWEB','FICT','FLEX','NETW');
  $pubArray = array('ADDWES','OSBMCG','SAMS','WROX','APRES','CORGI','CRUCIA','MSPRES','OREILL');


  //Checks if the Category and Publisher the user has entered are in the database
  if (!in_array($input['catID'],$catArray)) {
    $errors[] = "Enter a valid Category ID";
  }

  if (!in_array($input['pubID'],$pubArray)) {
    $errors[] = "Enter a valid Publisher ID";
  }

  //Trimming the entries so that there aren't any spaces at the start or end
  $input['bookTitle'] = trim($input['bookTitle']);
  $input['bookYear'] = trim($input['bookYear']);
  $input['pubID'] = trim($input['pubID']);
  $input['catID'] = trim($input['catID']);
  $input['bookPrice'] = trim($input['bookPrice']);

  //Sanitise the strings to remove html tags (<h1></h1>)
  $input['bookTitle'] = filter_var($input['bookTitle'], FILTER_SANITIZE_STRING);
  $input['bookYear'] = filter_var($input['bookYear'], FILTER_SANITIZE_STRING);
  $input['pubID'] = filter_var($input['pubID'], FILTER_SANITIZE_STRING);
  $input['catID'] = filter_var($input['catID'], FILTER_SANITIZE_STRING);
  $input['bookPrice'] = filter_var($input['bookPrice'], FILTER_SANITIZE_STRING);

  //Sanitise the strings to remove special characters (?!#'[]')
  $input['bookTitle'] = filter_var($input['bookTitle'], FILTER_SANITIZE_SPECIAL_CHARS);
  $input['bookYear'] = filter_var($input['bookYear'], FILTER_SANITIZE_SPECIAL_CHARS);
  $input['pubID'] = filter_var($input['pubID'], FILTER_SANITIZE_SPECIAL_CHARS);
  $input['catID'] = filter_var($input['catID'], FILTER_SANITIZE_SPECIAL_CHARS);
  $input['bookPrice'] = filter_var($input['bookPrice'], FILTER_SANITIZE_SPECIAL_CHARS);

  //Checking if the entries are empty
  if (empty($input['bookTitle'])) {
    $errors[] = "Enter a Title";
  }
  if (empty($input['bookYear'])) {
    $errors[] = "Enter a Year";
  }
  if (empty($input['pubID'])){
    $errors[] = "Enter a Publisher ID";
  }
  if (empty($input['catID'])) {
    $errors[] = "Enter a Category ID";
  }
  if (empty($input['bookPrice'])) {
    $errors[] = "Enter a Price";
  }

  //Checking string length
  if (strlen($input['bookTitle']>=100)) {
    $errors[] = "Enter a shorter title (Less than 100)";
  }
  if (strlen($input['pubID']>=10)) {
    $errors[] = "Enter a shorter Publishing ID (Less than 10)";
  }
  if (strlen($input['catID']>=10)) {
    $errors[] = "Enter a shorter Category ID (Less than 10)";
  }

  //Check if price is a float (Decimal number e.g. 12.53)
  if (!filter_var($input['bookPrice'], FILTER_VALIDATE_FLOAT)) {
    $errors[] = "Price must be a decimal number";
  }

  //Outputs the $input and $errors arrays so they can be used by show_errors() and process_form()
  return array($input,$errors);
}

//Function to share errors that have been detected
function show_errors(array $errors){
  foreach ($errors as $item) {
    $output=" ";
    $output.= "$item";
    return $output;
  }
}

//This function updates the database with the inputs that have been validated in validate_bookForm()
//function. It takes in the array created inside it
function process_form(array $input){
  try{
    //Establish a connection to the database
    $dbConn = getConnection();

    //SQL query to update the book using placeholders
    $sqlUpdate = "UPDATE NBL_books
                  SET bookTitle = :bookTitle,
                      bookYear = :bookYear,
                      pubID = :pubID,
                      catID = :catID,
                      bookPrice = :bookPrice
                  WHERE bookISBN = :bookISBN";

    //Preparing the query to prevent SQL injections
    $sqlPrepare = $dbConn->prepare($sqlUpdate);

    //Executing the query putting the data taken from the login form
    //and placing it into the placeholders
    $sqlPrepare->execute(array(
      ':bookTitle'=>$input['bookTitle'],
      ':bookYear'=>$input['bookYear'],
      ':pubID'=>$input['pubID'],
      ':catID'=>$input['catID'],
      ':bookPrice'=>$input['bookPrice'],
      ':bookISBN'=>$input['bookISBN']));
  }
  catch (Exception $e){
    echo $e->getMessage();
  }
}
?>