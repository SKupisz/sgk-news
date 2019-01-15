<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: index.php");
  exit();
}
$name = $_SESSION['zalogowany'];
$checkin = 1;
require_once "main/connect.php";

?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "settings/main.css"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="shortcut icon" type = "image/ico" href = "main/favicon.ico"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
<?php require_once "main/bar.php" ?>
<main id = "umain">
  <header id = "u10title">
    <?php
      if(isset($_SESSION['e_chpass']))
      {
        echo $_SESSION['e_chpass'];
        unset($_SESSION['e_chpass']);
      }
      else if(isset($_SESSION['e_delAcc']))
      {
        echo $_SESSION['e_delAcc'];
        unset($_SESSION['e_delAcc']);
      }
      else if(isset($_SESSION['e_apad']))
      {
        echo $_SESSION['e_apad'];
        unset($_SESSION['e_apad']);
      }
      else {
        echo $name;
      }
      ?>
  </header>
  <section id = "u11">
    <div id = "u11pass">
      <header class = "uheader" id = "passheader">
        Change your password
      </header>
      <form method = "post" action = "settings/changePassword.php">
        <div id = "u11passil">New password <input type = "password" id = "u11passi" name = "newpass" required placeholder = "Your new password"/></div>
<div id = "u11passil">Repeat password <input type = "password" id = "u11passi" name = "newpass2"  required placeholder = "Repeat password"/></div>
        <input type = "submit" value="Change password" id = "u11pass_submit"/>
      </form>
    </div>
    <div id = "u11del">
      <header class = "uheader">
        Delete your account
      </header>
      <form method = "post" action = "settings/deleteAccount.php">
        <div id = "u11passil">Write password to confirm <input type = "password" id = "u11passi" name = "confirmpass"  required placeholder = "Your password"/></div>
        <input type = "submit" value="Delete my account" id = "u11pass_submit"/>
      </form>
    </div>
    <div id = "u11promotion">
      <header class = "uheader" id = "promheader">
        Are you thinking of becoming an SGK-news admin?
      </header>
      <main id = "u11promcontent">
        <form method = "post" action = "settings/promotionMail.php">
          <section class = "u11promcontheader">Write to us, and we will write back on your e-mail</section>
          <textarea id = "u11promcont" name = "content" placeholder = "Write over here" required>
          </textarea><br>
          <input type = "submit" value = "Send" id = "u11promcontent_submit"/>
        </form>
      </main>
    </div>
  </section>
</main>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
