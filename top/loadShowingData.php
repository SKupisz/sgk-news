<?php
  $checkin = 1;
  require_once "main/connect.php";
  $connection = 1;
  try {
    $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    if($polaczenie->connect_errno != 0)
    {
      throw new Exception($polaczenie->connect_error);
    }
    else {
      $goAndGetData = $polaczenie->query("SELECT * FROM sent_articles_names WHERE id = $id");
      if(!$goAndGetData) throw new Exception($polaczenie->error);
      if($goAndGetData->num_rows == 0)
      {
        header("Location: index.php");
        exit();
      }
      $row = $goAndGetData->fetch_assoc();
      $postID = $row["id"];
      $from = $row['username'];
      $title = $row['title'];
      $views = $row['views'];
      $likes = $row['likes']; 
      $goAndGetTheContent = $polaczenie->query("SELECT * FROM sent_articles_parts WHERE postId = $postID ORDER BY part ASC");
      if(!$goAndGetTheContent) throw new Exception($polaczenie->error);
      if($goAndGetTheContent->num_rows == 0){
        $connection = 0;
      }     
      else{
        $content = "";
        $howMuch = $goAndGetTheContent->num_rows;
        for($i = 0 ; $i < $howMuch; $i++){
          $row = $goAndGetTheContent->fetch_assoc();
          $content.=$row["content"];
        }
        require_once("../../delta/decoding.php");
        $cypheringObject = new Decode;
        $content = $cypheringObject->toNormal($content);          
      }
      
      mysqli_close($polaczenie);
    }
  } catch (Exception $e) {
    $connection = 0;
  }

?>
