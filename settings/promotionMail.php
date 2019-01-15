<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_POST['content']))
{
  header("Location: ../settings.php");
  exit();
}
$content = $_POST['content'];
$content = htmlentities($content);
$checkin = 1;
require_once "../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $name = $_SESSION['zalogowany'];
    $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$name' AND authority = 1");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 0)
    {
      $_SESSION['e_apad'] = "You are already an admin";
      header("Location: ../settings.php");
      exit();
    }
    else {
      $row = $rezultat->fetch_assoc();
      $to = "szym-ku@wp.pl";
      $title = $name." promotion";
      mail($to,$title,$content." User address: ".$row['email']);
      $_SESSION['e_apad'] = "The e-mail has been sent. We will reply to your e-mail address";
      header("Location: ../settings.php");
      exit();
    }
  }
} catch (Exception $e) {
  $_SESSION['e_apad'] = "Sorry, you cannot connect right now. Try later";
  header("Location: ../settings.php");
  exit();
}

?>
