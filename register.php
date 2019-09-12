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
    <center>
  <?php require_once "main/bar.php";?>
<section id = "umain">
  <section id = "u10t"><?php if(isset($_SESSION['zalogowany'])){
    ?>Jesteś zalogowany!<?php
  }
  else if(isset($_SESSION['r_error']))
  {
    echo $_SESSION['r_error'];
    unset($_SESSION['r_error']);
  }
  else {
    ?><h2>Rejestracja</h2><?php
  }?></section>
  <?php if(isset($_SESSION['zalogowany'])){
  }
  else {
    ?>

  <form method="post" action = "go.php">
  <section id = "u11b">
    <section class="input"><input type = "text" name = "u11n" id = "u11ni" required placeholder = "Nazwa użytkownika"/></section>
    <section class="input"><input type = "password" name = "u11p" id = "u11pi" required placeholder = "Hasło"/></section>
    <section class="input"><input type = "password" name = "u11pr" id = "u11pri" required placeholder = "Powtórz hasło"/></section>
    <section class="input"><input type = "text" name = "u11e" id = "u11ei" required placeholder = "Adres E-mail"/></section>
    <section id="news"><p>Newsletter<input type="checkbox" name = "u11nt" id = "u11nti"/></p></section>
    <section id = "agreements">
          <p>Akceptuję
        <a href = "regulations.php" class = "u11ntagg">regulacje SGK-news</a>
          i
              <a class = "u11ntagg" href = "privacy_politic.php">politykę prywatności</a>
          <input type="checkbox"></p>
    </section>

  </section>
      
  <input type="submit" value="Confirm">

</form><?php } ?>
</section>
        
        </center>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
