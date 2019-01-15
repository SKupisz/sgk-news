<?php
$reg = fopen("regulations/SGK-news_regulations.txt","r");
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "regulations/main.css"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="shortcut icon" type = "image/ico" href = "main/favicon.ico"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
  <body>
  <?php require_once "main/bar.php" ?>
    <main id = "umain">
      <?php
      $counter = 0;
      while(!feof($reg))
      {
        if($counter == 0)
        {
          ?><header class = "header" id = "main"><?php
          echo fgets($reg);?></header><?php
        }
        else if($counter == 1 || $counter == 6 || $counter == 13 || $counter ==23 || $counter == 31)
        {
          ?><header class = "header" id = "usual"><?php
          echo fgets($reg);?></header><?php
        }
        else {
          echo fgets($reg)."<br>";
        }
        $counter++;
      }
      ?>
    </main>
  </body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
</html>
