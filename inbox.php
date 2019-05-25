<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  $pass = 0;
}
else {
  $pass = 1;
  require_once "inbox/loadData.php";
}

?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "inbox/main.css"/>
  <link rel = "stylesheet" type="text/css" href = "inbox/blMain.css"/>
  <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
<?php require_once "main/bar.php" ?>
<main id = "umain">
  <div class = "apologising">
    Sorry, this section is temporary not aviable because of technical problems
  </div>
</main>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
<script src="inbox/main.js"></script>
</html>
