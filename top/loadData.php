<?php
$checkin = 1;
require_once "main/connect.php";
$connection = 1;
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    if(isset($_SESSION['topwords']))
    {
      $id = $_SESSION['topwords']['id'];
      $from = $_SESSION['topwords']['from'];
      $title = $_SESSION['topwords']['title'];
      $content = $_SESSION['topwords']['content'];
      $words = $_SESSION['topwords']['words'];
      $views = $_SESSION['topwords']['views'];
      $tags = $_SESSION['topwords']['tags'];
      $likes = $_SESSION['topwords']['likes'];
      $length = count($id);
      unset($_SESSION['topwords']);
    }
    else if(isset($_SESSION['topimpression']))
    {
      $id = $_SESSION['topimpression']['id'];
      $from = $_SESSION['topimpression']['from'];
      $title = $_SESSION['topimpression']['title'];
      $content = $_SESSION['topimpression']['content'];
      $words = $_SESSION['topimpression']['words'];
      $views = $_SESSION['topimpression']['views'];
      $tags = $_SESSION['topimpression']['tags'];
      $likes = $_SESSION['topimpression']['likes'];
      $length = count($id);
      unset($_SESSION['topimpression']);
    }
    else if(isset($_SESSION['topname']))
    {
      $id = $_SESSION['topname']['id'];
      $from = $_SESSION['topname']['from'];
      $title = $_SESSION['topname']['title'];
      $content = $_SESSION['topname']['content'];
      $words = $_SESSION['topname']['words'];
      $views = $_SESSION['topname']['views'];
      $tags = $_SESSION['topname']['tags'];
      $likes = $_SESSION['topname']['likes'];
      $length = count($id);
      unset($_SESSION['topname']);
    }
    else if(isset($_SESSION['toptags_feedback']))
    {
      $id = $_SESSION['toptags_feedback']['id'];
      $from = $_SESSION['toptags_feedback']['from'];
      $title = $_SESSION['toptags_feedback']['title'];
      $content = $_SESSION['toptags_feedback']['content'];
      $words = $_SESSION['toptags_feedback']['words'];
      $views = $_SESSION['toptags_feedback']['views'];
      $tags = $_SESSION['toptags_feedback']['tags'];
      $likes = $_SESSION['toptags_feedback']['likes'];
      $length = count($id);
      unset($_SESSION['toptags_feedback']);
    }
    else if(isset($_SESSION['topname_none']) || isset($_SESSION['tags_none']))
    {
      $connection = 0;
    }
    else if(isset($_SESSION['topwords_error']) || isset($_SESSION['topimpression_error']) || isset($_SESSION['topName_error']) || isset($_SESSION['tagsError']))
    {
      $connection = 0;
      unset($_SESSION['topwords_error']);
      unset($_SESSION['topimpression_error']);
      unset($_SESSION['topName_error']);
      unset($_SESSION['tagsError']);
    }
    else {
      $rezultat = $polaczenie->query("SELECT * FROM sent_articles_names ORDER BY RAND()");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $from = array();
      $title = array();
      $content = array();
      $views = array();
      $row = array();
      $words = array();
      $id = array();
      $likes = array();
      $tags = array();
      $length = $rezultat->num_rows;
      if($length > 50)
      {
        $length = 50;
      }
      require_once("../../delta/decoding.php");
      $cypheringObject = new Decode;
      for($i = 0; $i < $length; $i++)
      {
        $row = $rezultat->fetch_assoc();
        $id[$i] = $row['id'];
        $from[$i] = $row["username"];
        $title[$i] = $row["title"];
        $content[$i] = $row["forShowing"];
        if(strlen($content[$i]) > 0){
          $finalContent = $cypheringObject->toNormal($content[$i]);
          $content[$i] = $finalContent;
        }

        $views[$i] = $row["views"];
        $words[$i] = $row['words'];
        $likes[$i] = $row['likes'];
        $tags[$i] = $row['tags'];
      }
      $id = array_reverse($id);
      $title = array_reverse($title);
      $content = array_reverse($content);
      $from = array_reverse($from);
      $views = array_reverse($views);
      $words = array_reverse($words);
      $likes = array_reverse($likes);
      $tags = array_reverse($tags);

    }
    $sql = "SELECT * FROM sent_images_location ORDER BY id DESC LIMIT 10";
    if(isset($_GET["n"]) && $_GET["n"] != 0){
      $number = (int)$_GET["n"];
      $forCheckTheNumber = (string)$number;
      if($forCheckTheNumber != $_GET["n"]){
        $number = 0;
        $_GET["n"] = 0;
      }
      else{
        $sql.=" OFFSET ".$number;
      }
    }
    else{
      $number = 0;
    }
    $forCheck = $polaczenie->query("SELECT COUNT(*) FROM sent_images_location");
    if(!$forCheck) throw new Exception($polaczenie->error);
    $row = $forCheck->fetch_assoc();
    $flag = 0;
    if($row["COUNT(*)"] < $number+10){
      $flag = 1;
    }
    $rezultat = $polaczenie->query($sql);
    if(!$rezultat) throw new Exception($polaczenie->error);
    $howManyImages = $rezultat->num_rows;
    $imagesId = array();
    $imagesFrom = array();
    $imagesAddress = array();
    $imagesViews = array();
    $imagesLikes = array();
    for($i = 0; $i < $howManyImages; $i++)
    {
      $row = $rezultat->fetch_assoc();
      $imagesId[$i] = $row['id'];
      $imagesFrom[$i] = $row['fromm'];
      $imagesAddress[$i] = $row['localAdress'];
      $imagesViews[$i] = $row['views'];
      $imagesLikes[$i] = $row['likes'];
    }
    $nowSounds = $polaczenie->query("SELECT * FROM sent_sounds_location ORDER BY title ASC");
    if(!$nowSounds) throw new Exception($connection->error);
    if($nowSounds->num_rows == 0){
      $ifSounds = 0;
    }
    else{
      $ifSounds = 1;
      $soundId = array();
      $soundtitle = array();
      $soundauthors = array();
      for($i = 0 ; $i < $nowSounds->num_rows; $i++){
        $row = $nowSounds->fetch_assoc();
        $soundId[$i] = $row["id"];
        $soundtitle[$i] = $row["title"];
        $soundauthors[$i] = $row["fromm"];
      }
    }
    $giveTheVideos = $polaczenie->query("SELECT * FROM sent_videos ORDER BY id DESC");
    if(!$giveTheVideos) throw new Exception($polaczenie->error);
    if($giveTheVideos->num_rows == 0){
      $ifVideos = 0;
    }
    else{
      $ifVideos = 1;
      $videoId = array();
      $videotitle = array();
      $videoauthor = array();
      $videoIcon = array();
      for($i = 0; $i < $giveTheVideos->num_rows; $i++){
        $row = $giveTheVideos->fetch_assoc();
        $videoId[$i] = $row["id"];
        $videotitle[$i] = $row["title"];
        $videoauthor[$i] = $row["fromm"];
        $videoIcon[$i] = $row["iconAddress"];
        if(strlen($videotitle[$i]) > 0){
          $videotitle[$i] = $cypheringObject->toNormal($videotitle[$i]);
        }
        if(strlen($videoauthor[$i]) > 0){
          $videoauthor[$i] = $cypheringObject->toNormal($videoauthor[$i]);
        }
        if(strlen($videoIcon[$i]) > 0){
          $videoIcon[$i] = $cypheringObject->toNormal($videoIcon[$i]);
        }
      }
    }
    mysqli_close($polaczenie);
  }
} catch (Exception $e) {
  $connection = 0;
}

?>
