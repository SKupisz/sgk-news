<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "login/login.css"/>
  <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
      <center>
    
  <?php require_once "main/bar.php";?>
<section id = "umain">
  <section id = "u10t">
    <?php if(isset($_SESSION['zalogowany']))
    {
      ?><header class = "signed-header">Jesteś zalogowana/y!</header><?php
    }
    else if(isset($_SESSION['r_error']))
    {
      echo $_SESSION['r_error'];
      unset($_SESSION['r_error']);
    }
    else {
    ?><h2>Zaloguj się</h2>
    <?php } ?></section>
    <?php if(!isset($_SESSION['zalogowany']))
    {
?>

  <form method="post" action="getIn.php">
      
    
      
    <section class = "u10wrapper">
        
        
    <section class="input"><p><input type="text" placeholder = "Nazwa użytkownika" name = "u10l" id = "u10li" required/></p></section>
        
    <section class="input"><p><input type="password" placeholder = "Hasło" name = "u10p" id = "u10pi" required/></p></section>
    
        <section id = "u10fp"><p id="password"><a  href = "login/forgot.php">Zapomniałeś/aś hasła?</a></p></section>
        
  </section>
      
    <input type="submit" id = "u10sb" value="Zaloguj się"/>
        
       
        
  </form>
<?php }?>
</section>
          
           </center>
          
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
