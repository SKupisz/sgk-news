<?php
if(!isset($checkin))
{
  header("Location: ../../sgk-news");
  exit();
}
require_once "main/connect.php";
$connection = 1;
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0){
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $nickname = $_SESSION['zalogowany'];
    $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$nickname'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows > 0)
    {
      $row = $rezultat->fetch_assoc();
      $level = $row['authority'];
      $email = $row['email'];
      $newsletter = $row['newsletter'];
      $post = $nickname."_post";
      $poczta = $polaczenie->query("SELECT * FROM $post WHERE unreaded = 1");
      if(!$poczta) throw new Exception($poczta->error);
      $length = $poczta->num_rows;
      $articles = $polaczenie->query("SELECT * FROM $nickname");
      if(!$articles) throw new Exception($polaczenie->error);
      $articles_length = $articles->num_rows;
    }
    else {
      $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$nickname'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $row = $rezultat->fetch_assoc();
      $level = $row['authority'];
      $email = $row['email'];
      $newsletter = $row['newsletter'];

      $post = $nickname."_post";
      $poczta = $polaczenie->query("SELECT * FROM $post WHERE unreaded = 1");
      if(!$poczta) throw new Exception($poczta->error);
      $length = $poczta->num_rows;
      $articles = $polaczenie->query("SELECT * FROM $nickname");
      if(!$articles) throw new Exception($polaczenie->error);
      $articles_length = $articles->num_rows;
    }
  }
} catch (Exception $e) {
  $connection = 0;
}

?>
