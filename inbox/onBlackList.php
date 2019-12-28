<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_POST['usernameToBlock']) && !isset($_REQUEST["u"]))
{
  header("Location: ../inbox.php");
  exit();
}
if(!isset($_REQUEST["u"])){
  $username = $_POST['usernameToBlock'];
  $mood = 1;
}
else{
  $id = $_REQUEST['u'];
  $idc = (int)$id;
  $idc = (string)$idc;
  if($idc != $id){
    echo "wrong id";
    exit();
  }
  $mood = 2;
}
if($mood == 1){
  if(ctype_alnum($username) == false)
  {
    $_SESSION['e_bladd'] = "User you wanna block does not exist";
    header("Location: ../inbox.php");
    exit();
  }
}

$checkin = 1;
require_once "../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $blIndex = $_SESSION['zalogowany']."_blacklist";
    if($mood == 2){
      $userPost = $_SESSION["zalogowany"]."_post";
      $checkTheUsername = $polaczenie->query("SELECT fromm FROM $userPost WHERE id = $id");
      if(!$checkTheUsername) throw new Exception($polaczenie->error);
      if($checkTheUsername->num_rows == 0){
        echo "wrong id";
        exit();
      }
      else{
        $row = $checkTheUsername->fetch_assoc();
        $username = $row["fromm"];
      }
    }
    $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$username'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 0)
    {
      $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$username'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      if($rezultat->num_rows == 0)
      {
        mysqli_close($polaczenie);
        if($mood == 1){
          $_SESSION['e_bladd'] = "User you want to block does not exist";
          header("Location: ../inbox.php");
          exit();
        }
        else{
          echo "user doesn't exist";
          exit();
        }
        
      }

    }
    $rezultat = $polaczenie->query("SELECT * FROM $blIndex WHERE username = '$username'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 1){
      mysqli_close($polaczenie);
      if($mood == 1){
        $_SESSION['e_bladd'] = "You have already blocked this user";
        header("Location: ../inbox.php");
        exit();
      }
      else{
        echo "user already blocked";
        exit();
      }
    }
    else{
      $rezultat = $polaczenie->query("INSERT INTO $blIndex VALUES(NULL,'$username',now())");
      if(!$rezultat) throw new Exception($polaczenie->error);
      mysqli_close($polaczenie);
      if($mood == 1){
        $_SESSION['e_bladd'] = "You have just blocked ".$username;
        header("Location: ../inbox.php");
        exit();
      }
      else{
        echo "user blocked";
        exit();
      }

    }
  }
} catch (Exception $e) {
  mysqli_close($polaczenie);
  if($mood == 1){
    $_SESSION['e_bladd'] = "There is no connection. Try later";
    header("Location: ../inbox.php");
    exit();
  }
  else{
    echo "Lost connection";
    exit();
  }
}

?>
