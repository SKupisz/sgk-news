<?php
$checkin = 1;
require_once "./main/connect.php";
$isConnection = 1;
try{
    $connection = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_user,$db_password,
    [PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    if(!isset($_GET["u"])){
        $getTheBulletinContent = $connection->prepare("SELECT * FROM bulletins ORDER BY publishingDate DESC");
        $getTheBulletinContent->execute();
        $howMany = $getTheBulletinContent->rowCount();
        $rows = array();
        for($i = 0 ; $i < $howMany; $i++){
            $row = $getTheBulletinContent->fetch(PDO::FETCH_ASSOC);
            $rows[$i] = $row;
        }
    }
    else{
        $number_first = $_GET["u"];
        $number = (int)$number_first;
        $numberTest = (string)$number;
        if($number != $number_first){
            $isConnection = 0;
        }
        else{
            $getThisBulletin = $connection->prepare("SELECT * FROM bulletins WHERE id = :id");
            $getThisBulletin->bindValue(":id",$number,PDO::PARAM_INT);
            $getThisBulletin->execute();
            $howMany = $getThisBulletin->rowCount();
            if($howMany == 0) $isConnection = 0;
            else{
                $row = $getThisBulletin->fetch(PDO::FETCH_ASSOC);
                $title = $row["title"];
                $content = $row["content"];
                $date = $row["publishingDate"];
                $isConnection = 2;
            }
        }

    }

    $connection = null;
} catch(Exception $e){
    $isConnection = 0;
}
?>