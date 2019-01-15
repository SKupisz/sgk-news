<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_POST['u9cbl_dn']))
{
  header("Location: ../inbox.php");
  exit();
}
$userIdP = $_POST['u9cbl_dn'];
$go = strlen($userIdP);
$userId = (String)(int)$userIdP;
if(strlen($userId) != $go)
{
  header("Location: ../inbox.php");
  exit();
}
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
    $userId = (int)$userId;
    $rezultat = $polaczenie->query("SELECT * FROM $list WHERE id = $userId");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 0)
    {
      throw new Exception($polaczenie->error);
    }
    else {
      $rezultat = $polaczenie->query("DELETE FROM $list WHERE id = $userId");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $_SESSION['delError'] = "User succesfully returned";
      header("Location: ../inbox.php");
      exit();
    }
  }
} catch (Exception $e) {
  $_SESSION['delError'] = "You cannot connect right now. Try later";
  header("Location: ../inbox.php");
  exit();
}

?>
