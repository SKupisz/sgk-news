<?php
session_start();
$politic = (isset($_POST['politic'])) ? 1 : 0;
$literature = (isset($_POST['literature'])) ? 1 : 0;
$science = (isset($_POST['science'])) ? 1 : 0;
$entertaiment = (isset($_POST['entertaiment'])) ? 1 : 0;
$politic = (isset($_POST['politic'])) ? 1 : 0;
$other = (isset($_POST['other'])) ? 1 : 0;
$checkin = 1;
require_once "../../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno !== 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $query = "SELECT * FROM sent_articles WHERE tags LIKE";
    if($politic == 1) $query.=" %politic%";
  }
} catch (Exception $e) {
  $_SESSION['tagsError'] = "Lost connection. Try later";
  header("Location: ../../top.php");
  exit();
}

?>
