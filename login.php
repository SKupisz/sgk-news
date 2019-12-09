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
  <?php require_once "main/bar.php";?>
<section id = "umain">
  <section id = "u10t">
    <?php if(isset($_SESSION['zalogowany']))
    {
      ?><header class = "signed-header">You are signed in!</header><?php
    }
    else if(isset($_SESSION['r_error']))
    {
      ?><header class = "signed-header"><?php echo $_SESSION['r_error'];?></header><?php
      unset($_SESSION['r_error']);
    }
    else {
    ?><h2>Sign in</h2>
    <?php } ?></section>
    <?php if(!isset($_SESSION['zalogowany']))
    {
?>

  <form method="post" action="getIn.php">
      
    
      
    <section class = "u10wrapper">
        
        
    <section class="input"><p><input type="text" placeholder = "Username" name = "u10l" id = "u10li" required/></p></section>
        
    <section class="input"><p><input type="password" placeholder = "Password" name = "u10p" id = "u10pi" required/></p></section>
    
        <section id = "u10fp"><p id="password"><a  href = "login/forgot.php">Forgot the password?</a></p></section>
        
  </section>
      
    <input type="submit" id = "u10sb" value="Sign in"/>
        
       
        
  </form>
<?php }?>
</section>
          
          
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
