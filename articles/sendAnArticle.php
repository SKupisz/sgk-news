<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_POST['u11wti']) || !isset($_POST['u11wtai']) || !isset($_POST['u11wtgai']))
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
$tags = $_POST['u11wtgai'];
$title = htmlentities($title,ENT_QUOTES,"UTF-8");
$content = htmlentities($content,ENT_QUOTES,"UTF-8");
$tags = htmlentities($tags,ENT_QUOTES,"UTF-8");
$content = str_replace("\n", "<br>", $content);
$tags = str_replace("\n"," ",$tags);
$checkin = 1;
require_once "../main/connect.php";

try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else{
    $user = $_SESSION['zalogowany'];
    $rezultat = $polaczenie->query("SELECT * FROM $user WHERE title = '$title'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $row = $rezultat->fetch_assoc();
      $id = $row['id'];
      $rezultat = $polaczenie->query("UPDATE $user SET article = '$content' WHERE id = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      exitInstructions("Your article has been sent");
    }
    else {
      $rezultat = $polaczenie->query("INSERT INTO $user VALUES (NULL,'$title','$content',1,'$tags')");
      if(!$rezultat) throw new Exception($polaczenie->error);
      exitInstructions("Your article has been sent");
    }
  }
} catch (Exception $e) {
  exitInstructions("You cannot connect right now. Try later");
}

?>
