<?php
if(!isset($pass))
{
  header("Location: index.php");
  exit();
}
$connection = 1;
$checkin = 1;
require_once "main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    if(!isset($_SESSION['zalogowany']))
    {
      header("Location: index.php");
      exit();
    }

    $nick = $_SESSION['zalogowany'];
    $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$nick'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $post = $_SESSION['zalogowany']."_post";
      $poczta = $polaczenie->query("SELECT * FROM $post WHERE unreaded = 0 OR unreaded = 1");
      if(!$poczta) throw new Exception($polaczenie->error);
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
      $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$nick'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($rezultat->num_rows > 0)
      {
        $post = $_SESSION['zalogowany']."_post";
        $poczta = $polaczenie->query("SELECT * FROM $post WHERE unreaded = 0 OR unreaded = 1");
        if(!$poczta) throw new Exception($polaczenie->error);
        if($poczta->num_rows == 0)
        {
          $post = 0;
        }
        else {
          $post = 1;
        }
        require "postService.php";
        mysqli_close($polaczenie);
      }
      else {
        mysqli_close($polaczenie);
        unset($_SESSION['zalogowany']);
        header("Location: index.php");
        exit();
      }
    }

  }
} catch (Exception $e) {
  $connection = 0;
}

?>
