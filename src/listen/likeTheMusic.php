<?php
session_start();
if(!isset($_REQUEST["id"])){
  exit();
}
if(!isset($_SESSION['zalogowany']))
{
  echo "Not signed";
  exit();
}
$id = $_REQUEST['id'];
$test_id = (int)$id;
if($id != $test_id || $id < 0)
{
  echo "Connection failure";
  exit();
}
$checkin = 1;
require_once "../../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $user = $_SESSION['zalogowany'];
    $user = htmlentities($user);
    $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$user'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 0)
    {
      $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$user'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $row = $rezultat->fetch_assoc();
      $uid = $row['id'];
    }
    else {
      $row = $rezultat->fetch_assoc();
      $uid = $row['id'];
    }
    $rezultat = $polaczenie->query("SELECT * FROM sent_sounds_likes WHERE soundId = $id AND userId = $uid");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows != 0)
    {
      $rezultat = $polaczenie->query("DELETE FROM sent_sounds_likes WHERE soundId = $uid AND userId = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $rezultat = $polaczenie->query("UPDATE sent_sounds_location SET likes = likes-1 WHERE id = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      echo "done lower";
      exit();
    }
    else {
      $rezultat = $polaczenie->query("INSERT INTO sent_sounds_likes VALUES(NULL,$id,$uid)");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $rezultat = $polaczenie->query("UPDATE sent_sounds_location SET likes = likes+1 WHERE id = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      echo "done upper";
      exit();
    }
  }
} catch (Exception $e) {
  echo "Connection failure ".$e->getMessage();
  exit();
}
/* TODO: zrób komunikację przez ajaxa z tym skryptem*/
?>
