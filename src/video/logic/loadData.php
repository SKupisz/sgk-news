<?php
session_start();
if(!isset($_GET["s"])){
    header("Location: ../");
    exit();
}
$s = $_GET["s"];
$test_s = (int)$s;
$test_s = (string)$test_s;
if($test_s != $s){
    header("Location: ../");
    exit();
}
else{
    $s = (int)$s;
}
$checkin = 1;
require_once $barDir."main/connect.php";
$work = 1;
try {
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    if($connection->connect_errno != 0){
        throw new Exception($connection->connect_error);
    }
    else{
        $giveTheAddress = $connection->query("SELECT * FROM sent_videos WHERE id = $s");
        if(!$giveTheAddress) throw new Exception($connection->error);
        if($giveTheAddress->num_rows == 0){
            $work = 0;
        }
        else{
            require_once("../inbox/encrypt.php");
            $base = new Encrypt();
            
            $row = $giveTheAddress->fetch_assoc(); 
            $title = $row["title"];
            $author = $row["fromm"];
            $format = $row["videoFormat"];
            $likes = $row["likes"];
            $dislikes = $row["dislikes"];
            $views = $row["views"];
            $image = $row["iconAddress"];

            $title = $base->goBack($title);
            $author = $base->goBack($author);
            if($image != ""){
                $image = $base->goBack($image);
            }
            $image = substr($image,3);
            $cookieName = $s."_videoStatus";
            if(!isset($_COOKIE[$cookieName])){
                $addTheViews = $connection->query("UPDATE sent_videos SET views = views+1 WHERE id = $s");
                if(!$addTheViews) throw new Exception($connection->error);
                setcookie($cookieName,"blocked",time()+3600,"/");               
            }
            mysqli_close($connection);
        }
    }
} catch (Exception $e) {
    $work = 0;
}
?>