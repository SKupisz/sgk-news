<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../");
  exit();
}
if(!isset($_POST['id']))
{
  header("Location: ../articles.php");
  exit();
}
$id = $_POST['id'];
$sid = (int)$id;
if($sid != $id)
{
  header("Location: ../articles.php");
  exit();
}
$checkin = 1;
$user = $_SESSION['zalogowany'];
require_once "../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if(!$polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $query = $polaczenie->query("SELECT * FROM $user WHERE id = $id");
    if(!$query) throw new Exception($polaczenie->error);
    if($query->num_rows == 0)
    {
      header("Location: ../articles.php");
      exit();
    }
    else {
      $query = $polaczenie->query("DELETE FROM $user WHERE id = $id");
      if(!$query) throw new Exception($polaczenie->error);
      header("Location: ../articles.php");
      exit();
    }
  }
} catch (Exception $e) {
  $_SESSION['deletingError'] = "Something went wrong. Try later";
  header("Location: ../articles.php");
  exit();
}

?>
