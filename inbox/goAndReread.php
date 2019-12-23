<?php
session_start();
if(!isset($_SESSION["zalogowany"])){
    header("Location: ../");
    exit();
}
if(!isset($_REQUEST["id"])){
    header("Location: ../inbox.php");
    exit();
}
else{
    $m = $_REQUEST["id"];
    $forCheckIfInt = (int)$m;
    $makeAPreviousState = (string)$forCheckIfInt;
    if($m != $makeAPreviousState){
        echo "wrong id";
        exit();
    }
    else{
        $checkin = 1;
        require_once "../main/connect.php";
        try {
            $connection = new mysqli($host,$db_user,$db_password,$db_name);
            if($connection->connect_errno != 0){
                throw new Exception($connection->connect_error);
            }
            else{
                $post = $_SESSION["zalogowany"]."_post";
                $markAsUnreaded = $connection->query("SELECT * FROM $post WHERE id = $forCheckIfInt");
                if(!$markAsUnreaded) throw new Exception($connection->error);
                if($markAsUnreaded->num_rows == 0){
                    echo "wrong id";
                    exit();
                }
                else{
                    $update = $connection->query("UPDATE $post SET unreaded = 0 WHERE id = $forCheckIfInt");
                    if(!$update) throw new Exception($connection->error);
                    mysqli_close($connection);
                    echo "unreaded";
                    exit();
                }
            }
        } catch (Exception $e) {
            mysqli_close($connection);
            echo "Lost connection";
            exit();
        }
    }
}