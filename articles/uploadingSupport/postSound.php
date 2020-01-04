<?php
function exitInstructions($type){
    $_SESSION['uploadSoundFail'] = $type;
    header("Location: ../../articles.php");
    exit();
}
if(!isset($_POST["title"]) || !isset($_FILES["fileToUpload"])){
    header("Location: ../../");
    exit();
}
$title = $_POST["title"];
$uploadingSound = $_FILES["fileToUpload"];
$name = $_FILES["fileToUpload"]["name"];
$uploadOk = 1;
if($uploadingSound["size"] > 32000000){
    $uploadOk = 0;
    exitInstructions("File too large");
}
$dir = "../../uploadedSounds/";
$target_dirname = $dir.basename($uploadingSound["name"]);
$soundType = strtolower(pathinfo($target_dirname,PATHINFO_EXTENSION));
$target_dirname = $dir.$title.".mp3";
$check = getimagesize($uploadingSound['tmp_name']);
if(file_exists($target_dirname)) 
{
  $uploadOk = 0;
  exitInstructions("File already exists");
}
if($soundType != "mp3" && $soundType != "mp4" && $soundType != "wav")
{
  $uploadOk = 0;
  exitInstructions("Not-allowed format");
}
if($uploadOk == 0){
    exitInstructions("Something went wrong. Try later");
}
else{
    if(move_uploaded_file($uploadingSound['tmp_name'],$target_dirname)){
        $checkin = 1;
        require_once "../../main/connect.php";
        try {
            $connection = new PDO("mysql:host=".$host.";dbname=".$db_name,$db_user,$db_password,[
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $query = $connection->prepare("INSERT INTO sent_sounds_location VALUES(NULL,:title,:addres)");
            $query->bindValue(":title",$title,PDO::PARAM_STR);
            $query->bindValue(":addres",$target_dirname,PDO::PARAM_STR);
            $query->execute();
            exitInstructions("Sound uploaded");
        } catch (Exception $e) {
            exitInstructions("Lost connection. Try later");
        }
        exit();
    }
    else{
        exitInstructions("Lost connection. Try later");
    }
}