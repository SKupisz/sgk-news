<?php
$checkin = 1;
require_once "./main/connect.php";
$isConnection = 1;
try{
    $connection = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_user,$db_password,
    [PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $getTheBulletinContent = $connection->prepare("SELECT * FROM bulletins");
    $getTheBulletinContent->execute();
    $howMany = $getTheBulletinContent->rowCount();
    $rows = array();
    for($i = 0 ; $i < $howMany; $i++){
        $row = $getTheBulletinContent->fetch(PDO::FETCH_ASSOC);
        $rows[$i] = $row;
    }
    $connection = null;
} catch(Exception $e){
    $isConnection = 0;
}
?>