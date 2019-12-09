<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_REQUEST['u']))
{
  header("Location: ../inbox.php");
  exit();
}
$userIdP = $_REQUEST['u'];
$userIdP = htmlentities($userIdP);
$checkin = 1;
require_once "../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $list = $_SESSION['zalogowany']."_blacklist";
    $rezultat = $polaczenie->query("SELECT * FROM $list WHERE username = '$userIdP'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 0)
    {
      throw new Exception($polaczenie->error);
    }
    else {
      $row = $rezultat->fetch_assoc();
      $idForDelete = $row['id'];
      $rezultat = $polaczenie->query("DELETE FROM $list WHERE id = $idForDelete");
      if(!$rezultat) throw new Exception($polaczenie->error);
      echo "User unblocked";
      exit();
    }
  }
} catch (Exception $e) {
  echo "You cannot connect right now. Try later";
  exit();
}

?>
