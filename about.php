<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "about/main.css"/>
    <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">    
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    
  <title> SGK-news </title>
</head>
<body onload = "preloader();" class = "onLoadCut">

<section id = "onLoadNot" class = "onLoadNot">
<?php require_once "main/bar.php" ?>

    
    <!--

    <main id = "umain">
  <header id = "u9">
    About us
  </header>
  <section id = "u10">
    <section id = "u10desc">The 28th of April 2018 - a date for SGK-news as important as the National Day for a country.
    That day, the first version of the main site has been written. After that, during the following months,
    we were developing our project - we added the main part of our website, a sign-up system, and
    an internal inbox, which is just like an email for our users.
    </section>

  <section id = "u11">
    <section id = "u11SK">
      <div id = "u11SKP"></div>
      <article id = "u11SKD">
        <nav id = "u11SKDwrapper">
        Simon George Kupisz - founder and CEO of SGK-news. Born in 2003 in Warsaw.
      </nav>
      </article>
    </section>
  </section>
  </section>     
</main>

-->

    <h1>O nas</h1>
    <hr>
<div class="right" id="text1" class="clearfix">
        <h2>
        Simon George Kupisz - founder and CEO of SGK-news. Born in 2003 in Warsaw. 
        </h2>
        <p>
        The 28th of April 2018 - a date for SGK-news as important as the National Day for a country. That day, the first version of the main site has been written. After that, during the following months, we were developing our project - we added the main part of our website, a sign-up system, and an internal inbox, which is just like an email for our users.
        </p>
    </div>
    <div class="left" class="clearfix">
        <img src="IMG_20180727_132956.jpg" id="pic1">
    </div> 


    
    
    
    
    
    
    


</section>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
<script src="about/main.js"></script>
</html>
