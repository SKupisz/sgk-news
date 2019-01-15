<?php
session_start();
if(!isset($_POST['u11n']) || !isset($_POST['u11p']) || !isset($_POST['u11pr']) || !isset($_POST['u11e']))
{
  header("Location: index.php");
  exit();
}
if(isset($_SESSION['zalogowany']))
{
  header("Location: index.php");
  exit();
}
$nick = $_POST['u11n'];
$pass = $_POST['u11p'];
$pass2 = $_POST['u11pr'];
$email = $_POST['u11e'];
$nick = htmlentities($nick);
$emailb = filter_var($email,FILTER_SANITIZE_EMAIL);
echo $emailb;

if($email != $emailb)
{
  $_SESSION['r_error'] = "Incorrect email";
  //require "main/scripts/errors.php";
  header("Location: register.php");
  exit();
}
if(strlen($pass) < 8)
{
  $_SESSION['r_error'] = "To short password";
  //require "main/scripts/errors.php";
  header("Location: register.php");
  exit();
}
if($pass != $pass2)
{
  $_SESSION['r_error'] = "Not the same passwords";
  //require "main/scripts/errors.php";
  header("Location: register.php");
  exit();
}
if(ctype_alnum($pass) == false)
{
  $_SESSION['r_error'] = "<label class = 'respfont'>Password must contain only alphanumeric signs</label>";
  //require "main/scripts/errors.php";
  header("Location: register.php");
  exit();
}
if(isset($_POST['u11nt']))
{
  $newsletter = 1;
}
else {
  $newsletter = 0;
}
$checkin = 1;
require_once"main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Excetion($polaczenie->connect_error);
  }
  else {

    $rezultat = $polaczenie->query("SELECT * FROM users WHERE username = '$nick'");
    if(!$rezultat) throw new Exception($polaczenie->error);

    $ile = $rezultat->num_rows;
    if($ile > 0)
    {
      $_SESSION['r_error'] = "Nickname already taken";
      //require "main/scripts/errors.php";
      header("Location: register.php");
      exit();
    }
    else {
      $rezultat = $polaczenie->query("SELECT * FROM admins WHERE username = '$nick'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $ile = $rezultat->num_rows;
      if($ile > 0)
      {
        $_SESSION['r_error'] = "Nickname already taken";
        //require "main/scripts/errors.php";
        header("Location: register.php");
        exit();
      }
    }
    $rezultat = $polaczenie->query("SELECT * FROM users WHERE email = '$emailb'");
    if(!$rezultat) throw new Exception($polaczenie->error);
    $ile = $rezultat->num_rows;
    if($ile > 0)
    {
      $row = $rezultat->fetch_assoc();
      $flaga = 0;
      for($i = 0 ; $i < strlen($emailb); $i++)
      {
        if($row['email'][$i] !== $emailb[$i])
        {
          $flaga = 1;
          break;
        }
      }
      if($flaga == 0)
      {
        $_SESSION['r_error'] = "Email already registed";
        //require "main/scripts/errors.php";
        header("Location: register.php");
        exit();
      }
    }
    else {
      $rezultat = $polaczenie->query("SELECT * FROM admins WHERE email = '$emailb'");
      if(!$rezultat) throw new Exception($polaczenie->error);
      $ile = $rezultat->num_rows;
      if($ile > 0)
      {
        $row = $rezultat->fetch_assoc();
        $flaga = 0;
        for($i = 0 ; $i < strlen($emailb); $i++)
        {
          if($row['email'][$i] !== $emailb[$i])
          {
            $flaga = 1;
            break;
          }
        }
        if($flaga == 0)
        {
          $_SESSION['r_error'] = "Email already registed";
          //require "main/scripts/errors.php";
          header("Location: register.php");
          exit();
        }
      }
    }
    $pass_hash = password_hash($pass,PASSWORD_DEFAULT);
    $rezultat = $polaczenie->query("INSERT INTO users VALUES(NULL,'$nick','$pass_hash','$email',1,$newsletter)");
    if(!$rezultat) throw new Exception($polaczenie->error);

    $sql = "CREATE TABLE $nick ( id INT NOT NULL AUTO_INCREMENT , title TEXT CHARACTER SET
      utf8 COLLATE utf8_polish_ci NOT NULL ,article TEXT CHARACTER SET
        utf8 COLLATE utf8_polish_ci NOT NULL ,status INT NOT NULL, PRIMARY KEY (id)) ENGINE = InnoDB CHARSET=utf8
      COLLATE utf8_polish_ci;";
    $rezultat = $polaczenie->query($sql);
    if(!$rezultat) throw new Exception($polaczenie->error);
    $bl = $nick."_blackList";
    $sql = "CREATE TABLE $bl ( id INT NOT NULL AUTO_INCREMENT , username TEXT CHARACTER SET
      utf8 COLLATE utf8_polish_ci NOT NULL ,dateOfBlocking DATE NOT NULL,PRIMARY KEY (id)) ENGINE = InnoDB CHARSET=utf8
      COLLATE utf8_polish_ci;";
    $rezultat = $polaczenie->query($sql);
    if(!$rezultat)
    {
      throw new Exception($polaczenie->error);
    }
    $post = $nick."_post";
    $sql = "CREATE TABLE $post ( id INT NOT NULL AUTO_INCREMENT , fromm TEXT CHARACTER SET
      utf8 COLLATE utf8_polish_ci NOT NULL ,title TEXT CHARACTER SET
        utf8 COLLATE utf8_polish_ci NOT NULL ,message TEXT CHARACTER SET
        utf8 COLLATE utf8_polish_ci NOT NULL ,unreaded INT NOT NULL,PRIMARY KEY (id)) ENGINE = InnoDB CHARSET=utf8
      COLLATE utf8_polish_ci;";
    $rezultat = $polaczenie->query($sql);
    if(!$rezultat) throw new Exception($polaczenie->error);
    $_SESSION['zalogowany'] = $nick;
    setcookie("username",$_SESSION['zalogowany'],time()+3600,"/");
    $_POST['nick'] = $nick;
    $_POST['pass'] = $pass;
    header("Location: register.php");
    exit();
  }
} catch (Exception $e) {
  $_SESSION['r_error'] = "Lost connection";
  //require "main/scripts/errors.php";
  header("Location: register.php");
  exit();
}

?>
