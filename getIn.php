<?php
session_start();
if(isset($_SESSION['zalogowany']))
{
  header("Location: login.php");
  exit();
}
if(!isset($_POST['u10p']) || !isset($_POST['u10l']))
{
  header("Location: login.php");
  exit();
}
$login = $_POST['u10l'];
$pass = $_POST['u10p'];
$login = htmlentities($login);
if(strlen($pass) < 8 || strlen($pass) > 20 || ctype_alnum($pass) == false)
{
  $_SESSION['r_error'] = "Incorrect login or password";
  //require "main/scripts/errors.php";
  header("Location: login.php");
  exit();
}
$checkin = 1;
require_once "main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$login'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0){
      $row = $rezultat->fetch_assoc();
      if(password_verify($pass,$row['password']))
      {
        $_SESSION['zalogowany'] = $login;
        header("Location: login.php");
        exit();
      }
      else {
        $_SESSION['r_error'] = "Wrong nickname or password";
        header("Location: login.php");
        exit();
      }
    }
    else {
      $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$login'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($rezultat->num_rows > 0){
        $row = $rezultat->fetch_assoc();
        if(password_verify($pass,$row['password']))
        {
          $_SESSION['zalogowany'] = $login;
          header("Location: login.php");
          exit();
        }
        else {
          $_SESSION['r_error'] = "Wrong nickname or password";
          header("Location: login.php");
          exit();
        }
    }
    else {
      $_SESSION['r_error'] = "Wrong nickname or password";
      header("Location: login.php");
      exit();
    }
  }
}} catch (Exception $e) {
  $_SESSION['r_error'] = "Sorry, you cannot connect right now";
  header("Location: login.php");
  exit();
}

?>
