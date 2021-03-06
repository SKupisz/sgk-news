<?php
if(!isset($checkin))
{
  header("Location: ../index.php");
  exit();
}
$work = 1;
require_once "main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else{
    $user = $_SESSION['zalogowany'];
    $rezultat = $polaczenie->query("SELECT * FROM $user WHERE status = 1 AND part = 0");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $bwtitles = Array();
    $bwids = Array();
    $bwlength = $rezultat->num_rows;
    for($i = 0; $i < $bwlength; $i++)
    {
      $row = $rezultat->fetch_assoc();
      $bwtitles[$i] = $row['title'];
      $bwids[$i] = $row['id'];
    }
    $bwtitles = array_reverse($bwtitles);
    $bwids = array_reverse($bwids);
    $rezultat = $polaczenie->query("SELECT * FROM $user WHERE status = 2 and part = 0");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $sarticles = Array();
    $sids = Array();
    $swords = Array();
    $sviews = Array();
    $snumber = Array();
    $ifPicturesInBase = -1;
    $slength = $rezultat->num_rows;
    for($i = 0; $i < $slength; $i++)
    {
      $row = $rezultat->fetch_assoc();
      $sarticles[$i] = $row['title'];
      $sids[$i] = $row['id'];

    }
    $sarticles = array_reverse($sarticles);
    $sids = array_reverse($sids);

    $rezultat = $polaczenie->query("SELECT * FROM sent_articles_names WHERE username = '$user'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    for($i = 0; $i < $rezultat->num_rows; $i++)
    {
      $row = $rezultat->fetch_assoc();
      $swords[$i] = $row['words'];
      $sviews[$i] = $row['views'];
      $snumber[$i] = $i+1;
    }
    $snumber = array_reverse($snumber);
    $sviews = array_reverse($sviews);
    $swords = array_reverse($swords);
    if($sid > 0)
    {
      $rezultat = $polaczenie->query("SELECT * FROM $user WHERE id = $sid AND status = 1");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($rezultat->num_rows == 0)
      {
        $sid = -1;
      }
      else {
        $row = $rezultat->fetch_assoc();
        if($row["part"] != 0){
          throw new Exception($polaczenie->error);
        }
        $sidname = $row['title'];
        $sidcontent = "";
        $i = 1;
        $searchForRows = $polaczenie->query("SELECT * FROM $user WHERE title = '$sidname' ORDER BY part ASC");
        if(!$searchForRows) throw new Exception($polaczenie->error);
        for($i = 0 ; $i < $searchForRows->num_rows; $i++){
          $row = $searchForRows->fetch_assoc();
          $sidcontent.=$row["article"];
        }
        require_once "./inbox/decoding.php";
        $dc = new Decode;
        $sidcontent = $dc->toNormal($sidcontent);
        $sidcontent = str_replace("<br>", "\n", $sidcontent);
        while($sidcontent[0] == " ")
        {
          $sidcontent = substr($sidcontent,1,strlen($sidcontent));
        }
        $baseTags = $row['tags'];
        $baseTags = explode(" ",$baseTags);
        ?><script><?php
        for($i = 0 ; $i < count($baseTags); $i++)
        {
          ?>let <?php echo $baseTags[$i];?> = 1;<?php
        }
        ?></script><?php
        $getThePictures = $polaczenie->query("SELECT * FROM waiting_articles_images_locations WHERE postId = $sid");
        if(!$getThePictures) throw new Exception($polaczenie->error);
        if($getThePictures->num_rows == 0){
          $ifPicturesInBase = 0;
        }
        else{
          $ifPicturesInBase = 1;
          $picAddress = array();
          for($i = 0 ; $i < $getThePictures->num_rows; $i++){
            $row = $getThePictures->fetch_assoc();
            $picAddress[$i] = $row["address"];
          }
        }
      }
    }
    else {
      $sid = -1;
    }
  }
} catch (Exception $e) {
  $work = 0;
}

?>
