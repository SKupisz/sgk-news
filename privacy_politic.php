<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "privacy/main.css"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="shortcut icon" type = "image/ico" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
  
    <main class = "umain">
      <header class = "u10header">
        Privacy politic
      </header>
      <article class = "u11content">
        <?php require_once "privacy/politic.php"?>
      </article>
</main>
</body>
<!--<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>-->
</html>
