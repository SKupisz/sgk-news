<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_POST['confirmpass']))
{
  header("Location: ../settings.php");
  exit();
}
$pass = $_POST['confirmpass'];
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
    $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$name'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $row = $rezultat->fetch_assoc();
      if(password_verify($pass,$row['password']))
      {
        $rezultat = $polaczenie->query("DELETE  FROM admins WHERE username = '$name'");
        if(!$rezultat) throw new Exception($polaczenie->error);
      }
      else {
        $_SESSION['e_delAcc'] = "Incorrect password";
        header("Location: ../settings.php");
        exit();
      }
    }
    else {
      $row = $rezultat->fetch_assoc();
      if(password_verify($pass,$row['password']))
      {
        $rezultat = $polaczenie->query("DELETE  FROM users WHERE username = '$name'");
        if(!$rezultat) throw new Exception($polaczenie->error);
      }
      else {
        $_SESSION['e_delAcc'] = "Incorrect password";
        header("Location: ../settings.php");
        exit();
      }
    }
    $rezultat = $polaczenie->query("DROP TABLE $name");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $post = $name."_post";
    $bl = $name."_blacklist";
    $rezultat = $polaczenie->query("DROP TABLE $post");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $rezultat = $polaczenie->query("DROP TABLE $bl");
    if(!$rezultat) throw new Exception($polaczenie->error);
    unset($_SESSION['zalogowany']);
    header("Location: ../index.php");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['e_delAcc'] = "Sorry, something went wrong. Try later";
  header("Location: ../settings.php");
  exit();
}

?>
