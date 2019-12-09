<?php
session_start();
if(!isset($_SESSION["zalogowany"])){
    header("Location: ../inbox.php");
    exit();
}

$checkin = 1;
require_once "../main/connect.php";
try{
    $connection = new mysqli($host,$db_user,$db_password,$db_name);
    if($connection->connect_errno != 0){
        throw new Exception($connection->connect_error);
    }
    else{
        $user = $_SESSION["zalogowany"];
        $ifExist = $connection->query("SELECT users.username, admins.username FROM users LEFT JOIN admins ON users.id = admins.id WHERE users.username = '$user'");
        if(!$ifExist) throw new Exception($connection->error);
        if($ifExist->num_rows == 0){
            echo "Something went wrong. Try later";
            exit();
        }
        else{
            $blackList = $user."_blacklist";
            $clearTheBase = $connection->query("TRUNCATE TABLE $blackList");
            if(!$clearTheBase) throw new Exception($connection->error);
            echo "cleared";
            exit();
        }
    }
} catch(Exception $e){
    echo "Lost connection. Try again";
    exit();
}
?>