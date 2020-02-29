<?php
$barDir = "../";
require_once $barDir."src/listen/logic/loadData.php";
?>
<!DOCTYPE html>
<html lang = "pl">
  <head>
    <meta charset="utf-8"/>
      <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href = "../main/bar.css"/>
      <link rel = "stylesheet" type = "text/css" href = "../top/main.css"/>
      <link rel = "stylesheet" type = "text/css" href = "../src/listen/css/main.css"/>
      <link rel="shortcut icon" type = "image/png" href = "../logo.png"/>
      <meta name="description" content="SGK-news website">
      <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
      <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    <title>SGK news</title>
  </head>
<body>
  <?php require_once "../main/bar.php";?>
  <main id = "umain"> 
    <?php
    if($work == 1){
      ?>    
      <header class="main-header"><?php echo $title;?></header>
      <footer class="author">By <?php echo $fromm;?></footer>
      <audio class = "local-song" id = "play<?php echo $s;?>" onended = "afterPlaying()">
          <source src = "<?php echo $address;?>" type = "audio/mp3"/>
      </audio> 
      <section class="music-section">
      <button class = "music-buttons play-button" id = "playId<?php echo $s;?>" onclick = "play('play<?php echo $s;?>')">
        ▶
      </button>
      <button class = "music-buttons reload-button" onclick = "reload('play<?php echo $s;?>')">⟳</button>
      
    </section>
    <section class="stats-section">
      <div class="views-container">
        <span class="views-emoji">👁️</span>
        <span class="views-quantity"><?php echo $views;?></span>
      </div>
      <div class="like-container">
        <button class="like-this-piece" onclick = "sendSoundLike(<?php echo $s;?>)">
        </button>   
      </div>
      <footer class="likes-quantity" id = "likes-quantity"><?php echo $likes;?></footer>
    </section>
    <?php }
    else{
      ?>
      <header class="main-header">Lost connection</header>
      <foother class="author">Try later</foother>
      <?php
    }
    ?>

  </main>
</body>
<script src = "../main/main.js"></script>
<script src="../src/node_modules/push.js/bin/push.min.js"></script>
<script src = "../src/listen/logic/music.js"></script>
</html>