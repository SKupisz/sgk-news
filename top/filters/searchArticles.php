<?php
session_start();
if(!isset($_POST['articleName']))
{
  header("Location: ../../top.php");
  exit();
}
$name = $_POST['articleName'];
$name = htmlentities($name);
$checkin = 1;
require_once"../../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $rezultat = $polaczenie->query("SELECT * FROM sent_articles WHERE title LIKE '%$name%' ORDER BY views");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $from = array();
      $title = array();
      $content = array();
      $views = array();
      $row = array();
      $words = array();
      $id = array();
      require_once"../filtersHelp/helpingLoadingWords.php";
      $_SESSION['topname'] = ['id'=>$id,
      'from'=>$from,
      'title'=>$title,
      'content'=>$content,
      'words'=>$words,
      'views'=>$views];
      mysqli_close($polaczenie);
      header("Location: ../../top.php");
      exit();
    }
    else {
      $_SESSION['topname_none'] = "There is no article you are looking for";
      mysqli_close($polaczenie);
      header("Location: ../../top.php");
      exit();
    }
  }
} catch (Exception $e) {
  $_SESSION['topName_error'] = "Something went wrong. Try later";
  header("Location: ../../top.php");
  exit();
}

?>
