<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
    try {
        //Opens the error file in reading type
        $fileHandle = fopen("error_log_file.log", "rb");
        //Goes through each line of the file
        while (!feof($fileHandle)) {
          $line = fgets($fileHandle);
          if($line){
            $line = trim($line);
            $part = explode('|',$line);
            echo "$part[0], $part[1]\n";
          }
        }
        fclose($fileHandle);
      } catch (\Exception $e) {
        echo "<p>There was an error, please try again</p>\n";
        log_error($e);
      }
     ?>

  </body>
</html>
