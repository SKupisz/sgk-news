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
    $rezultat = $polaczenie->query("INSERT INTO sent_articles VALUES(NULL,'$user','$title','$content',$words,0,0,'$tags')");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $rezultat = $polaczenie->query("UPDATE $user SET status = 2 WHERE id = $id");
    if(!$rezultat) throw new Exception($polaczenie->error);
    mysqli_close($polaczenie);
    exitInstructions("The article has been sent");
  }
} catch (Exception $e) {
  exitInstructions("Sorry, you cannot connect right now. Try later");
}

?>
