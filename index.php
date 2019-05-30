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
    <span id = "u9content">You want publish an article, but you don't know where? No problem! On SGK-news, you can share your creation. Remember - public news, your news, sgk-news </span>
  </section>
<div class = "rect-second"></div>
  <section id = "u10">
      <section id = "u10main">Who are we?</section>
      <a href = "about.php" id = "u10go">Check it!</a>

  </section>

  <section href="top.php" id = "u11">
    <a href = "top.php">
    <div class = "u11mainhanged">Check our Rankings</div>
  </a>

  </section>
  <section id = "links">
  </section>
</main>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
