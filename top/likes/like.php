<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../../");
  exit();
}
$id = $_GET['aid'];
$test_id = (int)$id;
if($id != $test_id || $id < 0)
{
  header("Location: ../../");
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
    $rezultat = $polaczenie->query("SELECT * FROM sent_likes WHERE postId = $id AND userId = $uid");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows != 0)
    {
      $rezultat = $polaczenie->query("DELETE FROM sent_likes WHERE userId = $uid AND postId = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $rezultat = $polaczenie->query("UPDATE sent_articles SET likes = likes-1 WHERE id = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $_SESSION['liking'] = "liking";
      header("Location: ../../showarticle.php?id=".$id);
      exit();
    }
    else {
      $rezultat = $polaczenie->query("INSERT INTO sent_likes VALUES(NULL,$id,$uid)");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $rezultat = $polaczenie->query("UPDATE sent_articles SET likes = likes+1 WHERE id = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $_SESSION['liking'] = "liking";
      header("Location: ../../showarticle.php?id=".$id);
      exit();
    }
  }
} catch (Exception $e) {
  $_SESSION['liking_error'] = "Lost connection";
  header("Location: ../../showarticle.php?id=".$id);
  exit();
}

?>
