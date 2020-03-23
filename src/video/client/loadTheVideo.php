<?php
if(!isset($_GET["s"])){
    header("Location: ../../../");
    exit();
}
$s = $_GET["s"];
$s = (int)$s;
$checkin = 1;
require_once "../../../main/connect.php";
$videoLoad = 1;
try {
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    if($connection->connect_errno != 0){
        throw new Exception($connection->connect_error);
    }
    else{
        $gettingTheRow = $connection->query("SELECT * FROM sent_videos WHERE id = $s");
        if(!$gettingTheRow) throw new Exception($connection->error);
        $row = $gettingTheRow->fetch_assoc();
        $video = $row["video"];
        $title = $row["title"];
        header("Content-type: video/mp4");
        echo $video;
    }
} catch (Exception $e) {
    $videoLoad = 0;
}

?>