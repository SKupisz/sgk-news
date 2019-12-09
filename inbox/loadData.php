<?php
if(!isset($pass))
{
  header("Location: index.php");
  exit();
}
$isConnected = 1;
$checkin = 1;
require_once "main/connect.php";
try {
  $connection = new mysqli($host,$db_user,$db_password,$db_name);
  if($connection->connect_errno != 0)
  {
    throw new Exception($connection->connect_error);
  }
  else {
    if(!isset($_SESSION['zalogowany']))
    {
      header("Location: index.php");
      exit();
    }

    $nick = $_SESSION['zalogowany'];
    $rezultat = $connection->query("SELECT * FROM users WHERE username = '$nick'");
    if(!$rezultat) throw new Exception($connection->error);
    if($rezultat->num_rows > 0)
    {
      $post = $_SESSION['zalogowany']."_post";
      $poczta = $connection->query("SELECT * FROM $post WHERE unreaded = 0 OR unreaded = 1");
      if(!$poczta) throw new Exception($connection->error);
      if($poczta->num_rows == 0)
      {
        $post = 0;
      }
      else {
        $post = 1;
      }
      require "postService.php";
    }
    else {
      $rezultat = $connection->query("SELECT * FROM admins WHERE username = '$nick'");
      if(!$rezultat) throw new Exception($connection->error);
      if($rezultat->num_rows > 0)
      {
        $post = $_SESSION['zalogowany']."_post";
        $poczta = $connection->query("SELECT * FROM $post WHERE unreaded = 0 OR unreaded = 1");
        if(!$poczta) throw new Exception($connection->error);
        if($poczta->num_rows == 0)
        {
          $post = 0;
        }
        else {
          $post = 1;
        }
        require "postService.php";
        
      }
      else {
        mysqli_close($connection);
        unset($_SESSION['zalogowany']);
        header("Location: index.php");
        exit();
      }
    }
    $blacklistAddress = $_SESSION["zalogowany"]."_blacklist";
    $result = $connection->query("SELECT * FROM $blacklistAddress");
    if(!$result) throw new Exception($connection->error);
    if($result->num_rows == 0){
      $ifBlackRows = 0;
    }
    else{
      $ifBlackRows = 1;
      $blockedNames = array();
      $blockedDates = array();
      for($i = 0 ; $i < $result->num_rows; $i++){
        $row = $result->fetch_assoc();
        $blockedNames[$i] = $row["username"];
        $blockedDates[$i] = $row["dateOfBlocking"];
      }
      $blockedNames = array_reverse($blockedNames);
      $blockedDates = array_reverse($blockedDates);
      $blockedLength = count($blockedNames);
    }
    

  }
} catch (Exception $e) {
  $isConnected = 0;
}

?>
