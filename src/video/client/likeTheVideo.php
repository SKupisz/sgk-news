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
require_once "../../../main/connect.php";
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
    $rezultat = $polaczenie->query("SELECT * FROM sent_videos_likes WHERE videoId = $id AND userId = $uid");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows != 0)
    {
      $row = $rezultat->fetch_assoc();
      $rezultat = $polaczenie->query("DELETE FROM sent_videos_likes WHERE videoId = $id AND userId = $uid");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($row["value"] >= 0){
        $rezultat = $polaczenie->query("UPDATE sent_videos SET likes = likes-1 WHERE id = $id");
        if(!$rezultat) throw new Exception($polaczenie->error);
        echo "done lower upper";
        exit();
      }
      else{
        $rezultat = $polaczenie->query("INSERT INTO sent_videos_likes VALUES(NULL,$id,$uid,1)");
        if(!$rezultat) throw new Exception($polaczenie->error);
        $rezultat = $polaczenie->query("UPDATE sent_videos SET dislikes = dislikes-1 WHERE id = $id");
        if(!$rezultat) throw new Exception($polaczenie->error);
        $rezultat = $polaczenie->query("UPDATE sent_videos SET likes = likes+1 WHERE id = $id");
        if(!$rezultat) throw new Exception($polaczenie->error);
        echo "done lower lower";
        exit();
      }

    }
    else {
      $rezultat = $polaczenie->query("INSERT INTO sent_videos_likes VALUES(NULL,$id,$uid,1)");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $rezultat = $polaczenie->query("UPDATE sent_videos SET likes = likes+1 WHERE id = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      echo "done upper";
      exit();
    }
  }
} catch (Exception $e) {
  echo "Connection failure ";
  exit();
}
?>
