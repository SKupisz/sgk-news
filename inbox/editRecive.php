<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_GET['nd']))
{
  header("Location: ../inbox.php");
  exit();
}
$alfa = $_GET['nd'];
if(strlen($alfa) == 0)
{
  header("Location: ../inbox.php");
  exit();
}
$table = Array();
$number = "";
$ind = 0;
for($i = 0 ; $i < strlen($alfa); $i++)
{
  if($alfa[$i] >= '0' && $alfa[$i] <= '9')
  {
    $number+=$alfa[$i];
  }
  else if($alfa[$i] == ","){
    $table[$ind] = (int)$number;
    $ind++;
    $number = "";
  }
  else {
    $_SESSION['e_post'] = "Post error: Incorrect data";
    header("Location: ../inbox.php");
    exit();
  }
}
if($number != "")
{
  $table[$ind] = (int)$number;
}
$checkin = 1;
require_once"../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $nick = $_SESSION['zalogowany'];
    $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$nick'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $go = 0;
    if($rezultat->num_rows > 0)
    {
      $go = 1;
    }
    else {
      $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$nick'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($rezultat->num_rows > 0)
      {
        $go = 1;
      }

    }
    if($go == 0)
    {
      mysqli_close($polaczenie);
      unset($_SESSION['zalogowany']);
      header("Location: ../index.php");
      exit();
    }
    $post = $nick."_post";
    for($i = 0 ; $i < count($alfa); $i++)
    {
      $number = $alfa[$i];
      $rezultat = $polaczenie->query("SELECT * FROM $post WHERE id = $number");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($rezultat->num_rows == 0)
      {
        mysqli_close($polaczenie);
        $_SESSION['e_post'] = "Post error: Incorrect Data";
        header("Location: ../inbox.php");
        exit();
      }
      $rezultat = $polaczenie->query("DELETE FROM $post WHERE id = $number");
      if(!$rezultat) throw new Exception($polaczenie->error);
      mysqli_close($polaczenie);
      header("Location: ../inbox.php");
      exit();
    }
  }
} catch (Exception $e) {
  mysqli_close($polaczenie);
  $_SESSION['e_post'] = "Sorry, you cannot connect right now. Try later";
  header("Location: ../inbox.php");
  exit();
}

?>
