<?php
session_start();

if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../../top.php");
  exit();
}
if(!isset($_GET['id']) || !isset($_POST['imageSumbitButton']))
{
  header("Location: ../../top.php");
  exit();
}
function exitInstructions($type,$thisId){
  $_SESSION['liking_image_feedback'] = $type;
  $located = "Location: ../../top.php?watchingImage=".$thisId;
  header($located);
  exit();
}

$id = $_GET['id'];
$sid = (int)$id;
if($sid != $id)
{
  header("Location: javascript://history.go(-1)");
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
      header("Location: ../../top.php?watchingImage=".$id);
      exit();
    }
    else {
      $checkIfLiked = $polaczenie->query("SELECT * FROM sent_image_likes WHERE imageId = $id");
      if($checkIfLiked->fetch_assoc())
      {
        $userId = $_SESSION['zalogowany_id'];
        $deleteLike = $polaczenie->query("DELETE FROM sent_image_likes WHERE imageId = $id AND userId = $userId");
        if(!$deleteLike) throw new Exception($polaczenie->error);
        $add = $polaczenie->query("UPDATE sent_images_location SET likes = likes-1 WHERE id = $id");
        if(!$add) throw new Exception($polaczenie->error);
        header("Location: ../../top.php?watchingImage=".$id);
        exit();
      }
      else {
        $userId = $_SESSION['zalogowany_id'];
        $insert = $polaczenie->query("INSERT INTO sent_image_likes VALUES(NULL,$id,$userId)");
        if(!$insert) throw new Exception($polaczenie->error);
        $add = $polaczenie->query("UPDATE sent_images_location SET likes = likes+1 WHERE id = $id");
        if(!$add) throw new Exception($polaczenie->error);
        header("Location: ../../top.php?watchingImage=".$id);
        exit();
      }
    }
  }


} catch (Exception $e) {
  exitInstructions($e->getMessage(),$id);
}

?>
