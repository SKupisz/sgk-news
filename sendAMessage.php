<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: index.php");
  exit();
}
if(!isset($_POST['u9mr']) || !isset($_POST['u9mc']) || !isset($_POST['u9mt']))
{
  header("Location: inbox.php");
  exit();
}
function exitInstructions($ename,$econtent,$name,$content,$title){
  $_SESSION[$ename] = $econtent;
  $_SESSION['e_reciver'] = $name;
  $_SESSION['e_content'] = $content;
  $_SESSION['e_title'] = $title;
  header("Location: inbox.php");
  exit();
}
$name = $_POST['u9mr'];
$content = $_POST['u9mc'];
$title = $_POST['u9mt'];

$name = htmlentities($name,ENT_QUOTES,"UTF-8");
$content = htmlentities($content,ENT_QUOTES,"UTF-8");
$title = htmlentities($title,ENT_QUOTES,"UTF-8");
$checkin = 1;
require_once"main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0){
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$name'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $go = 1;
    }
    else {
      $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$name'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($rezultat->num_rows > 0)
      {
        $go = 1;
      }
      else {
        $go = 0;
      }
    }
    if($go == 0)
    {
      //$_SESSION['e_mailing'] = "This user does not exist";
      exitInstructions("e_mailing","This user does not exist",$name,$content,$title);
    }
    else {
      $bl1 = $name."_blacklist";
      $bl2 = $_SESSION['zalogowany']."_blacklist";
      $user = $_SESSION['zalogowany'];
      require_once "inbox/encrypt.php";
      $rezultat = $polaczenie->query("SELECT * FROM $bl1 WHERE username = '$user'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $rezultat2 = $polaczenie->query("SELECT * FROM $bl2 WHERE username = '$name'");
      if(!$rezultat2) throw new Exception($polaczenie->error);
      if($rezultat->num_rows != 0)
      {
        exitInstructions("e_mailing","This user is blocking you. You cannot send a message",$name,$content,$title);
      }
      if($rezultat2->num_rows != 0)
      {
        exitInstructions("e_mailing","You are blocking this user. You cannot send a message",$name,$content,$title);
      }
      $post = $name."_post";
      $rezultat = $polaczenie->query("SELECT * FROM $post");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $content = str_replace("\n", "<br>", $content);
      $en = new Encrypt;
      $content = $en->goWithIt($content);
      $rezultat = $polaczenie->query("INSERT INTO $post VALUES(NULL,'$user','$title','$content',0)");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $_SESSION['e_mailing'] = "The message has been sent";
      header("Location: inbox.php");
      exit();
    }
  }
} catch (Exception $e) {
  $_SESSION['e_mailing'] = "You cannot connect right now. Try later";
  header("Location: inbox.php");
  exit();
}

?>
