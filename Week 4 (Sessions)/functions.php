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
   // Set key element = value
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
        // code...
        return true;
      }else{
        return false;
      }
    }
    
?>
