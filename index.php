<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "main.css"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <title> SGK-news </title>
  <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
</head>
<body>
<?php require_once "main/bar.php" ?>
<main id = "umain">
  <section id = "u9">
    <section id = "u9main"> What is SGK-news? </section>
    <span id = "u9content">It's a very advanced newspaper whereby you can be a web journalist even you haven't got an education </span>
    <div class = "background-rect rect-one"></div>
  </section>
<div class = "rect-second"></div>
  <section id = "u10">
      <section id = "u10main">Who are we?</section>
      <a href = "about.php" id = "u10go">Check it!</a>

  </section>

  <a href="top.php" id = "u11">
    <div id = "u11mainhanged">Check our Rankings</div>

  </a>
  <section id = "links">
  </section>
</main>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
