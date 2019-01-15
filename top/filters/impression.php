<?php
session_start();
if(!isset($_GET['b']))
{
  header("Location: ../../index.php");
  exit();
}
$b = $_GET['b'];
$b1 = (int)$b;
if($b != $b1)
{
  header("Location: ../../top.php");
  exit();
}
$checkin = 1;
require_once"../../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->error);
  }
  else {
    $rezultat = $polaczenie->query("SELECT * FROM sent_articles ORDER BY views");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $from = array();
    $title = array();
    $content = array();
    $views = array();
    $row = array();
    $words = array();
    $id = array();
    $length = $rezultat->num_rows;
    if($length > 50)
    {
      $length = 50;
    }
    for($i = 0; $i < $length; $i++)
    {
      $row = $rezultat->fetch_assoc();
      $id[$i] = $row['id'];
      $from[$i] = $row["username"];
      $title[$i] = $row["title"];
      $content[$i] = $row["content"];
      $views[$i] = $row["views"];
      $words[$i] = $row['words'];
    }
    if($b == 1)
    {
      $id = array_reverse($id);
      $title = array_reverse($title);
      $content = array_reverse($content);
      $from = array_reverse($from);
      $views = array_reverse($views);
      $words = array_reverse($words);
    }
    $_SESSION['topimpression'] = [
      "id"=>$id,
      "from"=>$from,
      "title"=>$title,
      "content"=>$content,
      "words"=>$words,
      "views"=>$views
    ];
    mysqli_close($polaczenie);
    header("Location: ../../top.php");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['topimpression_error'] = "Something went wron. Try later";
  header("Location: ../../top.php");
  exit();
}

?>
