<?php
session_start();

if(!isset($_SESSION['zalogowany']))
{
  echo "Not signed";
  exit();
}
if(!isset($_REQUEST["id"])){
  echo "Id missing";
  exit();
}

$id = $_REQUEST['id'];
$sid = (int)$id;
if($sid != $id)
{
  echo "Wrong id";
  exit();
}
$checkin = 1;
require_once "../../main/connect.php";

try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_errno);
  }
  else {
    $query = $polaczenie->query("SELECT * FROM sent_images_location WHERE id = $id");
    if(!$query) throw new Exception($polaczenie->error);
    $isItReal = $query->fetch_assoc();
    if(!$isItReal)
    {
      echo "Wrong id";
      exit();
    }
    else {
      $checkIfLiked = $polaczenie->query("SELECT * FROM sent_image_likes WHERE imageId = $id");
      if(!$checkIfLiked) throw new Exception($polaczenie->error);     
      if($checkIfLiked->num_rows > 0)
      {
        $userId = $_SESSION['zalogowany'];
        $deleteLike = $polaczenie->query("DELETE FROM sent_image_likes WHERE imageId = $id AND userId = '$userId'");
        if(!$deleteLike) throw new Exception($polaczenie->error);
        $add = $polaczenie->query("UPDATE sent_images_location SET likes = likes-1 WHERE id = $id");
        if(!$add) throw new Exception($polaczenie->error);
        echo "done lower";
        exit();
      }
      else {
        $userId = $_SESSION['zalogowany'];
        $insert = $polaczenie->query("INSERT INTO sent_image_likes VALUES(NULL,$id,'$userId')");
        if(!$insert) throw new Exception($polaczenie->error);
        $add = $polaczenie->query("UPDATE sent_images_location SET likes = likes+1 WHERE id = $id");
        if(!$add) throw new Exception($polaczenie->error);
        echo "done upper";
        exit();
      }
    }
  }


} catch (Exception $e) {
  echo "Connection failure";
  exit();
}

?>
