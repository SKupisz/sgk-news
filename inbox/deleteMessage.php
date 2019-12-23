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
    $id = $_REQUEST["id"];
    $idc = (int)$id; // checking if int
    $idc = (string)$idc;
    if($id != $idc){
        echo "wrong id";
        exit();
    }
    else{
        $id = (int)$id;
    }
    $checkin = 1;
    require_once "../main/connect.php";
    try {
        $connection = new mysqli($host,$db_user,$db_password,$db_name);
        if($connection->connect_errno != 0){
            throw new Exception($connection->connect_error);
        }
        else{
            $name = $_SESSION["zalogowany"]."_post";
            $checkIfExist = $connection->query("SELECT * FROM $name WHERE id = $id");
            if(!$checkIfExist) throw new Exception($connection->error);
            if($checkIfExist->num_rows == 0){
                echo "Message does not exist";
                exit();
            }
            else{
                $delete = $connection->query("DELETE FROM $name WHERE id = $id");
                if(!$delete) throw new Exception($connection->error);
                echo "cleared";
                mysqli_close($connection);
                exit();
            }
        }
    } catch (Exception $e) {
        echo "Wrong connection";
        exit();
    }
}
?>