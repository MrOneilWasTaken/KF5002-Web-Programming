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

function set_session($key, $value) {
  $_SESSION[$key] = $value;
  return true;
}

function get_session($key){
  if(isset($_SESSION[$key])){
    return $_SESSION[$key];
  }else{
    return false;
  }
}

function check_login(){
  if (get_session("logged-in")) {
    return true;
  }else{
    return false;
  }
}

/**
* define a function to be the global exception handler that
* will fire if no catch block is found
* @param $e
*/
function exceptionHandler ($e) {
	echo "<p><strong>Problem occured</strong></p>";
log_error($e);
}
/* now set the php exception handler to be the one above */
set_exception_handler('exceptionHandler');

/**
* define a function to be the global error handler, this will
* convert errors into exceptions.
*/
function errorHandler ($errno, $errstr, $errfile, $errline) {
// check error isn’t excluded by server settings
  if(!(error_reporting() & $errno)) {
return;
}
  throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
/* now set the php error handler to be the one above */
set_error_handler('errorHandler');

function log_error($e){
  //Opens the error file in writing mode
  $fileHandle = fopen('error_log_file.log', 'ab');
  //The current date and time set to a variable
  $errorDate = date('D M j G:i:s T Y');
  //Exception name
  $errorMessage = $e->getMessage();
  //All this replaces line breaks
  $toReplace = array("\r\n", "\n", "\r"); //chars to replace
	$replaceWith = '';
  $errorMessage = str_replace($toReplace, $replaceWith, $errorMessage);


  fwrite($fileHandle, "$errorDate | $errorMessage" .PHP_EOL);
  fclose($fileHandle);

}


?>
