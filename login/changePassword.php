<?php
session_start();
if(!isset($_POST['pass']) || !isset($_POST['pass2']))
{
  header("Location: ../login.php");
  exit();
}
$alfa = $_POST['pass'];
$beta = $_POST['pass2'];
$email = $_GET['email'];
$e1 = explode($email,".");
if(count($e1) != 1){
  header("location:javascript://history.go(-1)");
  exit();
}
require_once "../inbox/encrypt.php";
$ob = new Encrypt;
$cypher = $ob->goBack($email);
echo $cypher;
if($alfa != $beta || strlen($alfa) < 8 || strtolower($alfa) == $alfa || strtoupper($alfa) == $alfa)
{
  header("location:javascript://history.go(-1)");
  exit();
}
$checkin = 1;
require_once "../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if(!$polaczenie->connect_errno == 0)
  {
    throw new Exception($polaczenie->error);
  }
  else {

  }
} catch (Exception $e) {
  $_SESSION['changingFail'] = "Sorry, something went wrong. Try again";
  header("location:javascript://history.go(-1)");
  exit();
}

?>
