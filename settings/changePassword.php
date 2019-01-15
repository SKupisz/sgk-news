<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_POST['newpass']) || !isset($_POST['newpass2']))
{
  header("Location: ../settings.php");
  exit();
}
$pass = $_POST['newpass'];
$pass2 = $_POST['newpass2'];
if($pass != $pass2 || strlen($pass) < 8 || strlen($pass) > 20 || ctype_alnum($pass) == false)
{
  $_SESSION['e_chpass'] = "Your password must have more than 7 and less than 20 sings alphanumeric";
  header("Location: ../settings.php");
  exit();
}
$checkin = 1;
require_once "../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $pass = password_hash($pass,PASSWORD_DEFAULT);
    $name = $_SESSION['zalogowany'];
    $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$name'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $rezultat = $polaczenie->query("UPDATE users SET password = '$pass' WHERE username = '$name'");
      if(!$rezultat) throw new Exception($polaczenie->error);
    }
    else {
      $rezultat = $polaczenie->query("UPDATE admins SET password = '$pass' WHERE username = '$name'");
      if(!$rezultat) throw new Exception($polaczenie->error);
    }
    $_SESSION['e_chpass'] = "Password has been changed";
    header("Location: ../settings.php");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['e_chpass'] = "Sorry, something went wrong. Try later";
  header("Location: ../settings.php");
  exit();
}

?>
