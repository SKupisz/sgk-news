<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  $nickname = "Anonymus";
}
else {
  $nickname = $_SESSION['zalogowany'];
}
if(!isset($_POST['content']) || !isset($_GET['postId']))
{
  header("Location: javascript://history.go(-1)");
  exit();
}
$content = $_POST['content'];
$id = $_GET['postId'];
if($id != (int)$id)
{
  header("Location: javascript://history.go(-1)");
  exit();
}
$content = htmlentities($content,ENT_QUOTES,"UTF-8");
$checkin = 1;
require_once "../main/connect.php";
try {
  $polaczenie = new PDO('mysql:host='.$host.";dbname=".$db_name, $db_user,$db_password,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
  ]);
  $query = $polaczenie->prepare("INSERT INTO sent_comments VALUES(NULL,:postId,:userId,:content)");
  $query->bindValue(":postId",$id,PDO::PARAM_INT);
  $query->bindValue(":userId",$nickname,PDO::PARAM_STR);
  $query->bindValue(":content",$content,PDO::PARAM_STR);
  $query->execute();
  $_SESSION['comment_done'] = "true";
  header("Location: ../showarticle.php?id=$id");
  exit();
} catch (Exception $e) {
  $_SESSION['commentError'] = "Sorry, you cannot connet right now. Try later";
  header("Location: ../showarticle.php?id=$id");
  exit();
}

?>
