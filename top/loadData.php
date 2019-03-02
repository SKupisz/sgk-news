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
    if(isset($_SESSION['topwords']))
    {
      $id = $_SESSION['topwords']['id'];
      $from = $_SESSION['topwords']['from'];
      $title = $_SESSION['topwords']['title'];
      $content = $_SESSION['topwords']['content'];
      $words = $_SESSION['topwords']['words'];
      $views = $_SESSION['topwords']['views'];
      $tags = $_SESSION['topwords']['tags'];
      $likes = $_SESSION['topwords']['likes'];
      $length = count($id);
      unset($_SESSION['topwords']);
    }
    else if(isset($_SESSION['topimpression']))
    {
      $id = $_SESSION['topimpression']['id'];
      $from = $_SESSION['topimpression']['from'];
      $title = $_SESSION['topimpression']['title'];
      $content = $_SESSION['topimpression']['content'];
      $words = $_SESSION['topimpression']['words'];
      $views = $_SESSION['topimpression']['views'];
      $tags = $_SESSION['topimpression']['tags'];
      $likes = $_SESSION['topimpression']['likes'];
      $length = count($id);
      unset($_SESSION['topimpression']);
    }
    else if(isset($_SESSION['topname']))
    {
      $id = $_SESSION['topname']['id'];
      $from = $_SESSION['topname']['from'];
      $title = $_SESSION['topname']['title'];
      $content = $_SESSION['topname']['content'];
      $words = $_SESSION['topname']['words'];
      $views = $_SESSION['topname']['views'];
      $tags = $_SESSION['topname']['tags'];
      $likes = $_SESSION['topname']['likes'];
      echo count($likes);
      $length = count($id);
      unset($_SESSION['topname']);
    }
    else if(isset($_SESSION['topname_none']))
    {
      $connection = 0;
    }
    else if(isset($_SESSION['topwords_error']) || isset($_SESSION['topimpression_error']) || isset($_SESSION['topName_error']) || isset($_SESSION['tagsError']))
    {
      $connection = 0;
      unset($_SESSION['topwords_error']);
      unset($_SESSION['topimpression_error']);
      unset($_SESSION['topName_error']);
      unset($_SESSION['tagsError']);
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
      $likes = array();
      $tags = array();
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
        $likes[$i] = $row['likes'];
        $tags[$i] = $row['tags'];
      }
      $id = array_reverse($id);
      $title = array_reverse($title);
      $content = array_reverse($content);
      $from = array_reverse($from);
      $views = array_reverse($views);
      $words = array_reverse($words);
      $likes = array_reverse($likes);
      $tags = array_reverse($tags);
      mysqli_close($polaczenie);
    }

  }
} catch (Exception $e) {
  $connection = 0;
}

?>
