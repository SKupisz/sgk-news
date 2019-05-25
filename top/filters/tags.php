<?php
session_start();
$politic = (isset($_POST['politic'])) ? 1 : 0;
$literature = (isset($_POST['literature'])) ? 1 : 0;
$science = (isset($_POST['science'])) ? 1 : 0;
$entertaiment = (isset($_POST['entertaiment'])) ? 1 : 0;
$politic = (isset($_POST['politic'])) ? 1 : 0;
$other = (isset($_POST['other'])) ? 1 : 0;
$flag = 0;
$checkin = 1;
require_once "../../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $query = "SELECT * FROM sent_articles WHERE tags LIKE";
    if($politic == 1) {
      $query.=" '%politic%'";
      $flag = 1;
    }
    if($literature == 1)
    {
      if($flag == 1)
      {
        $query.=" OR tags LIKE";
      }
      $query.=" '%literature%'";
      $flag = 1;
    }
    if($science == 1)
    {
      if($flag == 1)
      {
        $query.=" OR tags LIKE";
      }
      $query.=" '%science%'";
      $flag = 1;
    }
    if($entertaiment == 1)
    {
      if($flag == 1)
      {
        $query.=" OR tags LIKE";
      }
      $query.=" '%entertaiment%'";
      $flag = 1;
    }
    if($other == 1)
    {
      if($flag == 1)
      {
        $query.=" OR tags LIKE";
      }
      $query.=" '%other%'";
      $flag = 1;
    }
    $rezultat = $polaczenie->query($query);
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $from = array();
      $title = array();
      $content = array();
      $views = array();
      $row = array();
      $words = array();
      $likes = array();
      $tags = array();
      $id = array();
      require_once"../filtersHelp/helpingLoadingWords.php";
      $_SESSION['toptags_feedback'] = ['id'=>$id,
      'from'=>$from,
      'title'=>$title,
      'content'=>$content,
      'words'=>$words,
      'views'=>$views,
      'tags'=>$tags,
      'likes'=>$likes];

    }
    else {
      $_SESSION['tags_none'] = "Sorry, there is no articles for this combination of tags";
    }
    header("Location: ../../top.php");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['tagsError'] = "Lost connection. Try later";
  header("Location: ../../top.php");
  exit();
}

?>
