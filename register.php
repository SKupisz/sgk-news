<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "register/main.css"/>
  <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
     <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <title> SGK-news </title>
</head>
<body>
  <?php require_once "main/bar.php";?>
<section id = "umain">
  <section id = "u10t"><?php if(isset($_SESSION['zalogowany'])){
    ?>You are signed in!<?php
  }
  else if(isset($_SESSION['r_error']))
  {
    echo $_SESSION['r_error'];
    unset($_SESSION['r_error']);
  }
  else {
    ?><h2>Sign up</h2><?php
  }?></section>
  <?php if(isset($_SESSION['zalogowany'])){
  }
  else {
    ?>

  <form method="post" action = "go.php">
  <section id = "u11b">
    <section class="input"><input type = "text" name = "u11n" id = "u11ni" required placeholder = "Username"/></section>
    <section class="input"><input type = "password" name = "u11p" id = "u11pi" required placeholder = "Password"/></section>
    <section class="input"><input type = "password" name = "u11pr" id = "u11pri" required placeholder = "Repeat password"/></section>
    <section class="input"><input type = "text" name = "u11e" id = "u11ei" required placeholder = "E-mail address"/></section>
    <section id="news"><p>Newsletter<input type="checkbox" name = "u11nt" id = "u11nti"/></p></section>
    <section id = "agreements">
          <p>I accept
        <a href = "regulations.php" class = "u11ntagg">the SGK-news regulations</a>
          and
              <a class = "u11ntagg" href = "privacy_politic.php">privacy politics</a>
          <input type="checkbox"></p>
    </section>

  </section>
      
  <input type="submit" value="Confirm">

</form><?php } ?>
</section>
        
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
