<?php
if(!$poczta){
  header("Location: ../index.php");
  exit();
}
if($post != 0){
  $from = array();
  $content = array();
  $title = array();
  $id = array();
  $mark = array();
  $l = $poczta->num_rows;
  require_once "./inbox/decoding.php";
  $dc = new Decode;
  for($i = 0 ; $i < $l; $i++)
  {
    $row = $poczta->fetch_assoc();
    $id[$i] = $row['id'];
    $from[$i] = $row['fromm'];
    $content[$i] = $row['message'];
    $title[$i] = $row['title'];
    $title[$i] = $dc->toNormal($title[$i]);
    $mark[$i] = $row["unreaded"];
  }
  $from = array_reverse($from);
  $content = array_reverse($content);
  $title = array_reverse($title);
  $id = array_reverse($id);
  $mark = array_reverse($mark);
}

$adres = $_SESSION['zalogowany']."_post";
$bl = $_SESSION['zalogowany']."_blackList";
$blist = $connection->query("SELECT * FROM $bl");
if(!$blist) throw new Exception($connection->error);
$names = array();
$dates = array();
$ids = array();
$ln = $blist->num_rows;
for($i = 0 ; $i < $ln; $i++)
{
  $row = $blist->fetch_assoc();
  $names[$i] = $row['username'];
  $dates[$i] = $row['dateOfBlocking'];
  $ids[$i] = $row['id'];
}
$names = array_reverse($names);
$dates = array_reverse($dates);
$ids = array_reverse($ids);?>
