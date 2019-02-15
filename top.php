<?php
session_start();
?>
<!DOCTYPE html>
<html lang = "pl">
  <head>
    <meta charset="utf-8"/>
      <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
      <link rel = "stylesheet" type = "text/css" href = "top/main.css"/>
      <link rel="shortcut icon" type = "image/ico" href = "main/favicon.ico"/>
      <meta name="description" content="SGK-news website">
      <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    <title>SGK news</title>
    <?php require_once"top/loadData.php"?>
  </head>
<body>
  <?php require_once "main/bar.php";?>
  <main id = "umain">
    <?php require_once "top/filters/filters.php" ?>
    <section class = "u11">
      <section class = "u11list">
      <?php
        if($connection == 0){
          ?>
          <section id = "u11article">
            <?php if(isset($_SESSION['topname_none']))
            {
              ?>
              <span id = "u11aofae">We are sorry</span>
              <section id = "u11av" class = "error">
                <?php echo $_SESSION['topname_none']; ?>
              </section><?php
              unset($_SESSION['topname_none']);
            }
            else {
              ?>
              <span id = "u11aofae">Ooops!...</span>
              <div id = "u11ate">Something went wrong</div>
              <section id = "u11av" class = "error">
                Sorry, you cannot connect right. Try later
              </section><?php
            }?>

          </section><?php
        }
        else {
          for($i = 0; $i < $length; $i++)
          {
            $now_id = $id[$i];
            $now_from = $from[$i];
            $now_title = $title[$i];
            $now_content = $content[$i];
            $now_views = $views[$i];
            $now_words = $words[$i];
            $now_likes = $likes[$i];
            $now_tags = $tags[$i];
            if(strlen($now_title) > 40){
              $now_title = substr($now_title,0,40)."...";
            }
            if(strpos($now_content,"<br>") !==false)
            {
              $now_content = substr($now_content,0,strpos($now_content,"<br>"))."...";
              if(strlen($now_content) > 300)
              {
                $now_content = substr($now_content,0,300)."...";
              }
            }
            else if(strlen($now_content) > 300)
            {
              $now_content = substr($now_content,0,300)."...";
            }

            ?>

            <a id = "u11article" style = "position: absolute; top: <?php echo 12+(50*$i);?>%;" href = "showarticle.php?id=<?php echo $now_id;?>" target = "_blank">
              <span id = "u11aofa"><?php echo $now_from;?></span>
              <div id = "u11at"><?php echo $now_title;?></div>
              <section id = "u11av">
                <?php echo $now_content; ?>
              </section>
              <?php
              if(strlen($now_tags) > 0)
              {
                ?><aside id = "u11info"><?php
              }
              else {
                ?><aside id = "u11tags"><?php
              }
              ?>

                <?php
                  if($now_views == 1)
                  {
                    ?>1 view<?php
                  }
                  else {
                    echo $now_views; ?> views<?php
                  }
                ?>
                ,
                <?php
                  if($now_words == 1){
                    ?> 1 word<?php
                  }
                  else {
                    echo $now_words; ?> words<?php
                  }
                ?>,
                <?php
                  if($now_likes == 1)
                  {
                    ?> 1 like<?php
                  }
                  else {
                    echo $now_likes;?> likes<?php
                  }
                ?>
              </aside>
              <aside id = "u11tags">
                <?php
                echo $now_tags;
                ?>
              </aside>
            </a>
            <?php
          }
        }
      ?>
    </section>
    </section>
  </main>
</body>

<script src = "main/main.js"></script>
<script src = "jquery-3-2-1.js"></script>
<script src = "top/main.js"></script>
</html>
