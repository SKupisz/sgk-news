<?php
session_start();
?>
<!DOCTYPE html>
<html lang = "pl">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href = "main.css"/>
    <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
    <link rel="stylesheet" type = "text/css" href = "./src/tutorial/css/main.css"/>  
    <title> SGK-news </title>
    <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
    <meta name="description" content="SGK-news website">
    <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">    
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
</head>
<body>
  <?php require_once "main/bar.php";?>
  <main id = "umain">
    <header class="main-header">Tutorial</header>
    <div class="short-describe">
        If you don't know how something on SGK-news works, just check here - there is a big chance you'll find what you want.
    </div>
    <section class="tutorials" id = "tutorials">

    </section>
  </main>
</body>

<script src="https://unpkg.com/react@16/umd/react.production.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.js" crossorigin></script>
<script src="https://unpkg.com/react@16.5.2/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@16.5.2/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/babel-standalone@6.26.0/babel.min.js"></script>
<script src = "main/main.js"></script>
<script src = "jquery-3-2-1.js"></script>
<script type = "text/jsx" src="./src/tutorial/logic/main.js"></script>
</html>
