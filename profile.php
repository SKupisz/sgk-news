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
  <header class = "u10t">
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

  <section class = "u10i">
    <section class = "u10ia">Authority level: <?php echo $level;?></section>
    <section class = "u10ic">The <?php echo $level;?> level of authority approves you to 
      <?php
      if($level == 1)
      {
        ?>write an article<?php
      }
      else if($level == 2){
        ?>write an article, promote and degrade other users<?php
      }
      else if($level == 3){
        ?>
        write an article,
        promote and degrade other users and
        write a newsletter to users
        <?php
      }
      ?></section>
  </section>
  <section class = "u10i">
    <header class = "u10ia">Inbox</header>
    <a href = "./inbox.php" class = "u10al">My inbox</a>
  </section>
  <section class = "u10a">
    <header class = "u10at">Articles</header>
    <section class = "u10ac">
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
      <a href = "articles.php" class = "u10al">My articles</a>
  </section>
<?php }?>
</main>
</body>
<script src="profile/main.js"></script>
<script src="main/main.js"></script>
</html>
