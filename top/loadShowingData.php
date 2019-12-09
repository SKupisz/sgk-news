<?php
  $checkin = 1;
  require_once"main/connect.php";
  $connection = 1;
  try {
    $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    if($polaczenie->connect_errno != 0)
    {
      throw new Exception($polaczenie->connect_error);
    }
    else {
      $rezultat = $polaczenie->query("SELECT * FROM sent_articles WHERE id = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($rezultat->num_rows == 0)
      {
        header("Location: index.php");
        exit();
      }
      $row = $rezultat->fetch_assoc();
      $from = $row['username'];
      $title = $row['title'];
      $content = $row['content'];
      $views = $row['views'];
      $likes = $row['likes'];
      require_once("../../delta/decoding.php");
      $cypheringObject = new Decode;
      $content = $cypheringObject->toNormal($content);
      
      mysqli_close($polaczenie);
    }
  } catch (Exception $e) {
    $connection = 0;
  }

?>
