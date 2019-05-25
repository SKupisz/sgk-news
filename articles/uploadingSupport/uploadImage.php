<?php
session_start();
function exitInstructions($type){
  $_SESSION['uploadImageFail'] = $type;
  header("Location: ../../articles.php");
  exit();
}
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../../index.php");
  exit();
}
if(!isset($_POST['submit']) || !isset($_FILES['fileToUpload']) || !isset($_POST['imageTitle']))
{
  header("Location: ../../articles.php");
  exit();
}
$toUpload = $_FILES['fileToUpload'];
$title = $_POST['imageTitle'];
$titleTestTable = explode(" ",$title);
if(count($titleTestTable) > 1)
{
  exitInstructions("Title can not contain spaces");
}
$dir = "../../uploadedImages/";
$uploadOk = 1;
$target_dirname = $dir.basename($_FILES["fileToUpload"]["name"]);
$imageType = strtolower(pathinfo($target_dirname,PATHINFO_EXTENSION));
$target_dirname = $dir.$title.".".$imageType;
$check = getimagesize($_FILES['fileToUpload']['tmp_name']);
$messageError = "";
/*if($check == true)
{
  //echo "File is an image - " . $check["mime"] . ".";
  $uploadOk = 1;
}
else {
  exitInstructions("File must be an image");
  $uploadOk = 0;
}*/
if(file_exists($target_dirname)) //sprawdzamy, czy jest
{
  exitInstructions("File with this title exists");
  $uploadOk = 0;
}
if($_FILES['fileToUpload']["size"] > 36000000) //checking size
{
  exitInstructions("File is too large");
  $uploadOk = 0;
}
if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
&& $imageType != "gif")
{
  exitInstructions("Only jpg, png, jpeg and gif format");
  $uploadOk = 0;
}
if($uploadOk == 0)
{
  exitInstructions("Failed to upload");
}
else {
  if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_dirname))
  {
    $checkin = 1;
    require_once "../../main/connect.php";
    $user = $_SESSION['zalogowany'];
    try {
      $polaczenie = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_user,$db_password,
      [PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      $query = $polaczenie->prepare("INSERT INTO sent_images_location VALUES(NULL,:user,:address,0,0)");
      $query->bindValue(":user",$user,PDO::PARAM_STR);
      $query->bindValue(":address",$target_dirname,PDO::PARAM_STR);
      $query->execute();
    } catch (Exception $e) {
      exitInstructions("Failed to upload. Try later");
    }

    exitInstructions("File uploaded!");
  }
  else {
    exitInstructions("Technical problems. Try later");
  }
}
