<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "login/main.css"/>
  <link rel="shortcut icon" type = "image/ico" href = "main/favicon.ico"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
  <?php require_once "main/bar.php";?>
<section id = "umain">
  <section id = "u10t">
    <?php if(isset($_SESSION['zalogowany']))
    {
      ?>You are logged in!<?php
    }
    else if(isset($_SESSION['r_error']))
    {
      echo $_SESSION['r_error'];
      unset($_SESSION['r_error']);
    }
    else {
    ?>Login
    <?php } ?></section>
    <?php if(!isset($_SESSION['zalogowany']))
    {
?>

  <form method="post" action="getIn.php">
    <section id = "u10l">Login >> <input type="text" name = "u10l" id = "u10li" required/></section>
    <section id = "u10p">Password >> <input type="password" name = "u10p" id = "u10pi" required/></section>
    <input type="submit" id = "u10sb" value="Log In"/>
  </form>
<?php }?>
</section>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
