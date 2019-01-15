<?php
session_start();
if(!isset($_GET['b']) || !isset($_GET['t']))
{
  header("Locaton: ../../top.php");
  exit();
}
$b = $_GET['b'];
$t = $_GET['t'];
$b1 = (int)$b;
$t1 = (int)$t;
if($b1 != $b || $t1 != $t)
{
  header("Location: ../../top.php");
  exit();
}
$checkin = 1;
require_once"../../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $id = array();
    $from = array();
    $title = array();
    $content = array();
    $words = array();
    $views = array();
    if($b == 0 && $t == 50)
    {
      $rezultat = $polaczenie->query("SELECT * FROM sent_articles WHERE words <= 50 ORDER BY views");
      if(!$rezultat) throw new Exception($polaczenie->error);
      require"../filtersHelp/helpingLoadingWords.php";
    }
    else if($b == 50 && $t == 100)
    {
      $rezultat = $polaczenie->query("SELECT * FROM sent_articles WHERE words BETWEEN 50 AND 100 ORDER BY views");
      if(!$rezultat) throw new Exception($polaczenie->error);
      require"../filtersHelp/helpingLoadingWords.php";
    }
    else if($b == 100 && $t == 200)
    {
      $rezultat = $polaczenie->query("SELECT * FROM sent_articles WHERE words BETWEEN 100 AND 200 ORDER BY views");
      if(!$rezultat) throw new Exception($polaczenie->error);
      require"../filtersHelp/helpingLoadingWords.php";
    }
    else if($b == 200 && $t == 300)
    {
      $rezultat = $polaczenie->query("SELECT * FROM sent_articles WHERE words BETWEEN 200 AND 300 ORDER BY views");
      if(!$rezultat) throw new Exception($polaczenie->error);
      require"../filtersHelp/helpingLoadingWords.php";
    }
    else if($b == 300 && $t ==0)
    {
      $rezultat = $polaczenie->query("SELECT * FROM sent_articles WHERE words >= 300 ORDER BY views");
      if(!$rezultat) throw new Exception($polaczenie->error);
      require"../filtersHelp/helpingLoadingWords.php";
    }
    else {
      mysqli_close($polaczenie);
      header("Location: ../../top.php");
      exit();
    }
    $_SESSION['topwords'] = ['id'=>$id,
    'from'=>$from,
    'title'=>$title,
    'content'=>$content,
    'words'=>$words,
    'views'=>$views];
    mysqli_close($polaczenie);
    header("Location: ../../top.php");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['topwords_error'] = "Sorry, you cannot connect right now. Try later";
  header("Location: ../../top.php");
  exit();
}

?>
