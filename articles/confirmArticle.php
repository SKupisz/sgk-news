<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_POST['id']))
{
  header("Location: ../articles.php");
  exit();
}
$id = $_POST['id'];
$ids = (Int)$id;
$id2 = (String)$ids;
if($id2 != $id)
{
  header("Location: ../articles.php");
  exit();
}
$id = $ids;
$checkin = 1;
require_once "../main/connect.php";
function exitInstructions($content){
  $_SESSION['e_artc'] = $content;
  header("Location: ../articles.php");
  exit();
}
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $user = $_SESSION['zalogowany'];
    $rezultat = $polaczenie->query("SELECT * FROM $user WHERE id = $id");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $row = $rezultat->fetch_assoc();
    $title = $row['title'];
    $content = $row['article'];
    $tags = $row['tags'];
    $words = str_word_count($content);
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
    /*$rezultat = $polaczenie->query("INSERT INTO sent_articles VALUES(NULL,'$user','$title','$content',$words,0,0,'$tags')");
    if(!$rezultat) throw new Exception($polaczenie->error);*/
    $newDirective = $polaczenie->query("INSERT INTO sent_articles_names VALUES(NULL,'$user','$title',$words,0,0,'$tags')");
    if(!$newDirective) throw new Exception($connection->error);
    $getIdOfAPreviewQuery = $polaczenie->query("SELECT id FROM sent_articles_names WHERE username = '$user' AND title='$title' AND tags = '$tags' AND words = $words ORDER BY id DESC");
    if(!$getIdOfAPreviewQuery) throw new Exception($connection->error);
    if($getIdOfAPreviewQuery->num_rows == 0){
      exitInstructions("Something went wrong. Try later");
    }
    else{
      $row = $getIdOfAPreviewQuery->fetch_assoc();
      $postID = $row["id"];
      for($i = 0; $i < count($finalParts); $i++){
        $localContent = $finalParts[$i];
        $insertPart = $polaczenie->query("INSERT INTO sent_articles_parts VALUES(NULL,$postID,$i,'$localContent')");
        if(!$insertPart){
          if($i != 0){
            $firstDel = $polaczenie->query("DELETE FROM sent_articles_names WHERE id = $postID");
            if(!$firstDel) throw new Exception($polaczenie->error);
            for($j = $i; $j > 0 ;$j--){
              $exit = $polaczenie->query("DELETE FROM sent_articles_parts WHERE postId = $postID");
              if(!$exit) throw new Exception($polaczenie->error);
            }
          }
          throw new Exception($polaczenie->error);
        }
      }
    }
    $rezultat = $polaczenie->query("UPDATE $user SET status = 2 WHERE id = $id");
    if(!$rezultat) throw new Exception($polaczenie->error);
    mysqli_close($polaczenie);
    exitInstructions("The article has been sent");
  }
} catch (Exception $e) {
  exitInstructions("Sorry, you cannot connect right now. Try later");
}

?>
