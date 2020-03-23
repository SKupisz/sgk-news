<?php
session_start();
if(!isset($_SESSION["zalogowany"]) || !isset($_GET["v"])){
    header("Location: ../../../");
    exit();
}
if(!isset($_POST["comment-content"])){
    header("Location: ../../../video/?s=".$_GET["v"]);
    exit();
}
$v = $_GET["v"];
$int_v = (int)$v;
$int_v = (string)$v;
if($v != $int_v){
    header("Location: ../../../video/?s=".$_GET["v"]);
    exit();
}
$v = (int)$v;
$content = $_POST["comment-content"];
$content = htmlentities($content,ENT_QUOTES,"UTF-8");
if(strlen($content) > 2000){
    $_SESSION["e_comment"] = "Your comment can contain max 2'000 words.";
    header("Location: ../../../video/?s=".$_GET["v"]);
    exit();   
}

$checkin = 1;
require_once "../../../main/connect.php";
try {
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    if($connection->connect_errno != 0){
        throw new Exception($connection->connect_error);
    }
    else{
        require_once "../../../inbox/cyphering.php";
        $base = new Cypher();
        $content = $base->toDelta($content,rand(1024,3000),1,1);
        $uid = $_SESSION["zalogowany_id"];
        $user = $_SESSION["zalogowany"];
        $user = $base->toDelta($user,rand(1024,3000),1,1);
        $insertTheComment = $connection->query("INSERT INTO sent_videos_comments VALUES(NULL,$v,$uid,'$user','$content')");
        if(!$insertTheComment) throw new Exception($connection->error);
        mysqli_close($connection);
        $_SESSION["e_comment"] = "Comment successfully posted";
        header("Location: ../../../video/?s=".$_GET["v"]);
        exit();   
    }
} catch (Exception $e) {
    $_SESSION["e_comment"] = "Lost connection. Try later";
    header("Location: ../../../video/?s=".$_GET["v"]);
    exit(); 
}

?>