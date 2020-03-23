<?php
session_start();
if(!isset($_SESSION["zalogowany"])){
    header("Location: ../../");
    exit();
}

if(!isset($_POST["title"]) || !isset($_FILES["fileToUpload"])){
    header("Location: ../../articles.php");
    exit();
}
function exitInstructions($type){
    $_SESSION['uploadSoundFail'] = $type;
    header("Location: ../../articles.php");
    exit();
}
$title = $_POST["title"];
$title = htmlentities($title,ENT_QUOTES,"UTF-8");
if(is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){
    $type = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
    if(!($type == "mp4" || $type == "webm" || $type == "ogg")){
        exitInstructions("Only MP4, WebM and Ogg formats");
    }
    if($_FILES["fileToUpload"]["size"] > 320000000){
        exitInstructions("Video is too large");
    }
    $videoData = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
    if(isset($_POST["video-icon-title"]) && isset($_FILES["photoToUpload"])){
        if($_FILES["photoToUpload"]["size"] > 3200000){
            exitInstructions("Photo is too large");
        }
        if($_FILES["photoToUpload"]["size"] > 0){
            $imageType = strtolower(pathinfo($_FILES["photoToUpload"]["name"],PATHINFO_EXTENSION));
            if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
            && $imageType != "gif" && $imageType != "webp")
            {
                exitInstructions("Only jpg, png, jpeg,webp and gif format ");
            }
            $ifIcon = 1;
        }
        else{
            $ifIcon = 0;
        }

    }
    else{
        $ifIcon = 0;
    }
    $checkin = 1;
    require_once "../../main/connect.php";
    try {
        $connection = new mysqli($host,$db_user,$db_password,$db_name);
        if($connection->connect_errno != 0){
            throw new Exception($connection->connect_error);
        }
        else{
            $user = $_SESSION["zalogowany"];
            $checkIfPut = $connection->query("SELECT * FROM sent_videos WHERE title = '$title' and fromm = '$user'");
            if(!$checkIfPut) throw new Exception($connection->error);
            if($checkIfPut->num_rows != 0){
                exitInstructions("You have already published a movie with this title");
            }
            require_once("../../inbox/cyphering.php");
            $base = new Cypher();
            $title = $base->toDelta($title,rand(1024,3000),1,1);
            $user = $base->toDelta($user,rand(1024,3000),1,1);
            $insertToTheDataBase = $connection->query("INSERT INTO sent_videos VALUES(NULL,'$title','$user','{$videoData}','$type',0,0,0,'$iconAddress')");
            if(!$insertToTheDataBase) throw new Exception($connection->error);
            if($ifIcon == 1){
                $gettingThePreviousId = $connection->query("SELECT * FROM sent_videos WHERE title = '$title' and fromm = '$user' and views = 0 and likes = 0 and dislikes = 0");
                if(!$gettingThePreviousId) throw new Exception($connection->error);
                if($gettingThePreviousId->num_rows != 1){
                    exitInstructions("Something went wrong. Try later");
                }
                $row = $gettingThePreviousId->fetch_assoc(); 
                $theVideoID = $row["id"];
                $iconDir = "../../videoIcons/".$theVideoID."_icon.webp";
                if(move_uploaded_file($_FILES["photoToUpload"]["tmp_name"],$iconDir)){
                    $iconDir = $base->toDelta($iconDir,rand(1024,3000),1,1);
                    $update = $connection->query("UPDATE sent_videos SET iconAddress = '$iconDir' WHERE id = $theVideoID");
                    if(!$update) throw new Exception($connection->error);
                }
                else{
                    exitInstructions("Something went wrong. Try later");
                }
            }
            exitInstructions("Your video has just been uploaded");
        }
    } catch (Exception $e) {
        exitInstructions("Lost connection. Try later ");
    }
}
else{
    exitInstructions("Something went wrong. Try later");
}
?>