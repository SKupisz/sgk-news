<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_POST['u11moreInfo']) || !isset($_POST['u11wti']) || !isset($_POST['u11wtai']))
{
  header("Location: ../articles.php");
  exit();
}
function exitInstructions($content){
  $_SESSION['e_art'] = $content;
  header("Location: ../articles.php");
  exit();
}
$title = $_POST['u11wti'];
$content = $_POST['u11wtai'];
$tags = $_POST['u11moreInfo'];
$title = htmlentities($title,ENT_QUOTES,"UTF-8");
$content = htmlentities($content,ENT_QUOTES,"UTF-8");
$words = str_word_count($content); 
$content = str_replace("\n", "<br>", $content);
$tags = str_replace("Tag","",$tags);
$idForTheImage = -1;
$checkin = 1;

if(isset($_POST["to_public"])){
  $status = 2;
}
else{
  $status = 1;
}

require_once "../main/connect.php";

try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else{
    $user = $_SESSION['zalogowany'];
    require_once("../inbox/cyphering.php");
    $base = new Cypher();
    $content = $base->toDelta($content,rand(1024,3000),1,1);
    if(strlen($content) > 30000){
      $counter = 0;
      $finalParts = array();
      for($i = 0 ; $i < strlen($content); $i+=30000){
          if($i == strlen($content) - 1){
              $sub = substr($content,$i);
          }
          else{
              $sub = substr($content,$i,30000);
          }
          $finalParts[$counter] = $sub;
          $counter++;
      }
    }
    else{
        $finalParts = array();
        $finalParts[0] = $content;
    }
    $rezultat = $polaczenie->query("SELECT * FROM $user WHERE title = '$title' ORDER BY part ASC");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $l = $rezultat->num_rows;
      $postId = 0;
      for($i = 0 ; $i < $l; $i++){
        $row = $rezultat->fetch_assoc();
        $id = $row['id'];
        if($i < count($finalParts)){
          $localContent = $finalParts[$i];
          $update = $polaczenie->query("UPDATE $user SET article = '$localContent' WHERE id = $id");
          if(!$update) throw new Exception($polaczenie->error);
          $update = $polaczenie->query("UPDATE $user SET tags = '$tags' WHERE id = $id");
          if(!$update) throw new Exception($polaczenie->error);
          if($status == 2){
            $update = $polaczenie->query("UPDATE $user SET status = $status WHERE id = $id");
            if(!$update) throw new Exception($polaczenie->error);
            if($i == 0){
              $gettingIntoPublic = $polaczenie->query("INSERT INTO sent_articles_names VALUES (NULL,'$user','$title','$localContent',$words,0,0,'$tags')");
              if(!$gettingIntoPublic) throw new Exception($polaczenie->error);
              $getTheId = $polaczenie->query("SELECT * FROM sent_articles_names WHERE username = '$user' AND title = '$title' AND forShowing = '$localContent' ORDER BY id DESC");
              if(!$getTheId) throw new Exception($polaczenie->error);
              $gettingIDRow = $getTheId->fetch_assoc();
              $postId = $gettingIDRow["id"];
            }
            $insertPart = $polaczenie->query("INSERT INTO sent_articles_parts VALUES(NULL,$postId,$i,'$localContent')");
            if(!$insertPart) throw new Exception($polaczenie->error);
          }
        }
        else{
          $del = $polaczenie->query("DELETE FROM $user WHERE id = $id");
          if(!$del) throw new Exception($polaczenie->error);
        }
      }
      if(count($finalParts) > $l){
        for($i = $l; $i < count($finalParts); $i++){
          $localContent = $finalParts[$i];
          $insert = $polaczenie->query("INSERT INTO $user VALUES(NULL,'$title','$localContent',1,'$tags',$i");
          if(!$insert) throw new Exception($polaczenie->error);
        }
      }
      exitInstructions("Your article has been updated");
    }
    else {
      $postId = -1;
      for($i = 0; $i < count($finalParts); $i++){
        $localContent = $finalParts[$i];
        $insertPart = $polaczenie->query("INSERT INTO $user VALUES (NULL,'$title','$localContent',$status,'$tags',$i)");
        if(!$insertPart){
          throw new Exception($polaczenie->error);
        }
        if($status == 2){
          if($i == 0){
            $insertOfficial = $polaczenie->query("INSERT INTO sent_articles_names VALUES (NULL,'$user','$title','$localContent',$words,0,0,'$tags')");
            if(!$insertOfficial) throw new Exception($polaczenie->error);
            $getTheId = $polaczenie->query("SELECT * FROM sent_articles_names WHERE username = '$user' AND title = '$title' AND forShowing = '$localContent' ORDER BY id DESC");
            if(!$getTheId) throw new Exception($polaczenie->error);
            $gettingIDRow = $getTheId->fetch_assoc();
            $postId = $gettingIDRow["id"];
            $idForTheImage = $postId;
          }
          $insertPart = $polaczenie->query("INSERT INTO sent_articles_parts VALUES(NULL,$postId,$i,'$localContent')");
          if(!$insertPart) throw new Exception($polaczenie->error);
        }
      }
      if($status == 2 && !(isset($_POST["first-name"]) && isset($_FILES["first-photo"]))){
        exitInstructions("Your article has been sent");
      }
      
    }
    if($status == 2){
      require_once "./uploadingSupport/uploadingImagesToArticle.php";
    }
  }
} catch (Exception $e) {
  exitInstructions("You cannot connect right now. Try later ".$e->getMessage());
}

?>
