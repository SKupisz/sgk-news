<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: index.php");
  exit();
}
$checkin = 0;
require_once"profile/loadData.php";
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "profile/main.css"/>
  <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
<?php require_once "main/bar.php" ?>
<main id = "umain">
  <header id = "u10t">
  <?php
  if($connection == 1)
  {
    echo $_SESSION['zalogowany'];
  }
  else {
    ?>You cannot connect right now. Try it later<?php
  }
  ?></header>
  <?php if($connection == 1)
  {
    ?>

  <section id = "u10i">
    <section id = "u10ia">Authority level: <?php echo $level;?> <label id = "u10ial">(?)</label></section>
    <section id = "u10ic">The <?php echo $level;?> level of authority approves you to:
        <br>
      <?php
      if($level == 1)
      {
        ?>Write an article<?php
      }
      else if($level == 2){
        ?>Write an article<br>Promote and degrade other users<?php
      }
      else if($level == 3){
        ?>
        Write an article<br>
        Promote and degrade other users<br>
        Write a newsletter to users
        <?php
      }
      ?></section>
  </section>
  <section id = "u10p">
    <div id = "u10pbc"></div>
    <header class = "u10pt">Inbox</header>
    <section id = "u10phc"><label id = "u10ph"><?php if($length > 0) echo $length;?></label></section>
    <!--<section id = "u10pc">You have <?php
     if($length == 0)
     {
       ?>not any unreaded message<?php
     }
     else if($length == 1){
      echo $length; ?> unreaded message<?php
    }
    else {
      echo $length; ?> unreaded messages<?php
    }?></section>--><br>
    <a href="inbox.php" id = "u10pl">Check the inbox</a>
  </section>
  <section id = "u10a">
    <header class = "u10pt">Articles</header>
    <section class = "u10ptsmall">
      <?php if($articles_length == 0){
        ?>You haven't written any articles yet<?php
      }
      else if($articles_length == 1)
      {
        ?>You have written 1 article<?php
      }
      else {
        ?>You have written <?php echo $articles_length;?> articles<?php
      }?></section>
      <a href = "articles.php" id = "u10al">My articles</a>
  </section>
<?php }?>
</main>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="profile/main.js"></script>
<script src="main/main.js"></script>
</html>
