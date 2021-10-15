<?php

/**
 * Script for KF5002 Web Programming 'Ajax Workshop'
 * Requires student to upload an SQL table 'animals'
 * Requires student to have 'functions.php' containing getConnection function.
 * 
 * To output HTML: getAnimals.php
 * To output JSON: getAnimals.php?useJSON
 * To output XML: getAnimals.php?useXML
 */


try {
  /**
   * The student must create functions.php. 
   * It must contain a getConnection() function.
   */
  require_once('functions.php');
  $dbConn = getConnection();

  /**
   * If the parameter useJSON is set then return JSON headers and content
   */
  if (isset($_REQUEST['useJSON'])) {
    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8"); 
    header("Access-Control-Allow-Methods: GET, POST");
    echo getJSONanimal($dbConn);
    exit();
  }

  /**
   * If the parameter useXML is set then return XML headers and content
   */
  if (isset($_REQUEST['useXML'])) {
    header('Content-Type: application/xml; charset=UTF-8');
    echo getXMLanimal($dbConn);
    exit();
  }

   /**
   * If no parameter set then return HTML
   */
  echo getHTMLanimal($dbConn);
}

catch (Exception $e) {
  throw new Exception("Error " . $e->getMessage(), 0, $e);
}

/**
 * Returns HTML 
 * The SQL query itself generates the HTML
 */
function getHTMLanimal($dbConn) {
  try {
    $sql = "select concat('<div class=\"animal\">\n  <img src=\"img/',filename,'\" alt=\"',description,'\">\n  <p><span class=\"creator\">Created by: ',creator_firstname, ' ', creator_lastname,'</span></p>\n  <p><span class=\"source\">Source: ',source,'</span></p>\n  <p><span class=\"description\">Description: ',description,'</span></p>\n</div>') as animal from animals order by rand() limit 1";

    $rsAnimal = $dbConn->query($sql);
    $animal = $rsAnimal->fetchObject();
    return $animal->animal;
  } 
    catch (Exception $e) {
      return "Problem: " . $e->getMessage();
    }
}

/**
 * Returns JSON 
 * PDO returns an associative array which is then 'structured' and encoded into JSON
 */
function getJSONanimal($dbConn) {
  try {
    $sql = "SELECT filename, creator_firstname, creator_lastname, source, description, created FROM animals ORDER BY rand() LIMIT 1";
    $rsAnimal = $dbConn->query($sql);;
    $animal = $rsAnimal->fetchAll(PDO::FETCH_ASSOC);

    $structuredAnimal["filename"] = $animal[0]['filename']; 
    $structuredAnimal["creator"]["firstname"] = $animal[0]['creator_firstname']; 
    $structuredAnimal["creator"]["lastname"] = $animal[0]['creator_lastname']; 
    $structuredAnimal["source"] = $animal[0]['source']; 
    $structuredAnimal["description"] = $animal[0]['description']; 
    $structuredAnimal["created"] = $animal[0]['created']; 

    return json_encode($structuredAnimal);

  }
  catch (Exception $e) {
    return "Problem: " . $e->getMessage();
  }
}

/**
 * Helper function for generating XML
 * This is a recursive function that calls itself when there is an array
 */
function xmlLoop($animal) {
  $output = "";
  foreach ($animal as $key => $value) {
    if (is_array($value)) {
      $output .=  "<$key>";
      $output.=xmlLoop($value);
      $output .=  "</$key>";
    } else {
        $output .=  "<$key>$value</$key>";
    }
  }
  return $output;
}


/**
 * Returns XML
 * The query and array re-structuring is exactly the same as getJSONanimal, but used to generate XML 
 */
function getXMLanimal($dbConn) {
  try {
    $sql = "SELECT filename, creator_firstname, creator_lastname, source, description, created FROM animals ORDER BY rand() LIMIT 1";
    $rsAnimal = $dbConn->query($sql);;
    $animal = $rsAnimal->fetchAll(PDO::FETCH_ASSOC);

    $structuredAnimal["filename"] = $animal[0]['filename']; 
    $structuredAnimal["creator"]["firstname"] = $animal[0]['creator_firstname']; 
    $structuredAnimal["creator"]["lastname"] = $animal[0]['creator_lastname']; 
    $structuredAnimal["source"] = $animal[0]['source']; 
    $structuredAnimal["description"] = $animal[0]['description']; 
    $structuredAnimal["created"] = $animal[0]['created']; 

    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    $xml .="<animal>";
    $xml .= xmlLoop($structuredAnimal);
    $xml .= "</animal>";

    return $xml;

  } catch (Exception $e) {
      return "Problem: " . $e->getMessage();
  }
}
?>