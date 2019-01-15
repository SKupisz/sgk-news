<?php
$connection = 1;
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $polaczenie.close();
  }
} catch (Exception $e) {
  $connection = 0;
}

?>
