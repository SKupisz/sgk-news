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
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">    
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
</head>
    
    
<body>
    
    
    
<?php require_once "main/bar.php";?>
    
<div class="mainindex">    
    
       <div class="whatnews">
        <h1>What is SGK-news?</h1>
        <p> Well, it could be hard to define, but in simple words, it's an online newspaper where the users are journalists. Interested how did it all start? 
          <a id="readmore" href="about.php">Read more!</a></p>
       </div>

        <hr>
        
       <div class="browseartices">
        <h1>Check out the articles!</h1>
        <p>After writing an article, it can be published. Then, your work will be visible in the top articles section. Which kind of articles do you prefer? About science? Or about politic? Or maybe you just want to read 
          some relaxing story? 
        <a id="przegladaj" href="top.php">Go and check this out!</a></p>
       </div>

       <hr>

        <div class="writeartc">
        <h1>Write an article!</h1>
        <p>Have you ever written some good piece of work, but had no idea where to publish it? Now, it's no more a problem - on SGK-news, you can share your talent with the world (just make sure it doesn't collide with our <a href = "regulations.php">regulations</a>). We're sure it's going to be one of your best decisions.
        <a id="przegladaj" href="articles.php">Sign in and start creating!</a></p>
       </div>
    


    <div class="footer">
      

    <p>&copy; 2020 SGK News</p>

    </div>
        


  </div> 
    
    
    
    
    
</body>


<script src="main/main.js"></script>
</html>
