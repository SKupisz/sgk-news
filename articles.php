<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: index.php");
  exit();
}
$checkin = 1;
require_once "articles/sid.php";
require_once "articles/loadData.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
      <link rel = "stylesheet" type = "text/css" href = "articles/main.css"/>
      <link rel="shortcut icon" type = "image/ico" href = "main/favicon.ico"/>
      <meta name="description" content="SGK-news website">
      <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    <title>SGK news</title>
  </head>
  <body onload = "preloader();" class = "onLoadCut">
      <section id = "preloader" progressbar>
        <figure class = "ourLogo">
          <img src = "./noweLogo2.png" alt = "logo"/>
        </figure>
      </section>
    <?php require_once "main/bar.php";?>
    <main id = "umain">
      <section class = "more-other-wrapper">
      <?php
      if($work == 0)
      {
        ?>
        <section id = "u10wrong">
          Sorry, someting went wrong...<br>
          Try again
        </section>
        <?php
      }
      else {
      ?>
      <header id = "u10bar">
        <div id = "u10barContainer">
          <?php if(isset($_SESSION['e_art']))
          {
            echo $_SESSION['e_art'];
            unset($_SESSION['e_art']);
          }
          else if(isset($_SESSION['e_artc']))
          {
            echo $_SESSION['e_artc'];
          }
          else {
            ?>Your articles<?php
          }
        ?>
      </div>
      </header>
      <section id = "u11titles">
        <div id = "u11a" onclick = "beingWrittenOpen();">Being Written</div>
        <div id = "u11s" onclick = "sentOpen();">Sent</div>
        <div id = "u11c" onclick = "confirmedOpen();">Confirmed</div>
        <div id = "u11w" onclick = "writingOpen();">Write<label class = "u11wasr"> an article</label></div>
      </section>
      <section id = "u11projects">
        <section id = "u11asection">
          <?php require_once "articles/beingWrittenTable.php";?>
        </section>
        <section id = "u11ssection">
          <?php require_once "articles/sentTable.php"; ?>
        </section>
        <section id = "u11csection">
        </section>
        <section id = "u11wsection">
          <form method = "post" action = "articles/sendAnArticle.php">
            <section id = "u11wti">Title <input type = "text" name = "u11wti" value = "<?php if($sid != -1){
              echo $sidname;
            }?>"/></section>
            <section id = "u11wta">
              <div class = "u11wtadesc">Article content</div>
              <textarea id = "u11wtai" name = "u11wtai" placeholder="Write here...">
                <?php if($sid != -1)
                {
                  echo $sidcontent;
                }?></textarea>
            </section>
            <section class = "u11wtga">
              <div class = "u11wtadesc">Tags(optional)</div>
              <span class = "u11wtmain">
                <button type="button" class = "u11wttag" id = "politicTag">Politic</button>
                <button type="button" class = "u11wttag" id = "entertaimentTag">Entertaiment</button>
                <button type="button" class = "u11wttag" id = "literatureTag">Literature</button>
                <button type="button" class = "u11wttag" id = "scienceTag">Science</button>
                <button type="button" class = "u11wttag" id = "otherTag">Other</button>
              </span>
              <input type = "hidden" name = "u11moreInfo" class = "u11moreInfo"/>
            </section>
            <button type = "submit" id = "u11was">
               Send<label class = "u11wasr"> an article</label> to waiting room
            </button>
          </form>
        </section>
      </section>
    <?php }?>
  </section>
      <section id = "u12more">
        <header class = "u12more-header">
        </header>
        <span class = "u12statistic" id = "words">
        </span>
        <span class = "u12statistic" id = "views">
        </span>
        <section class = "u12statistic modify" id = "place">
        </section>
        <button class = "u12close" onclick = "closeStatistic();">
          X
        </button>
      </section>

    </main>
  </body>
  <script>
  <?php if(isset($_SESSION['e_artc']))
  {
    ?>beingWrittenOpen();<?php
    unset($_SESSION['e_artc']);
  }
  if($sid != -1)
  {
    ?>writingOpen();<?php
  }

?>

  </script>
  <script src = "main/jquery-3-2-1.js"></script>
  <script src = "main/main.js"></script>
  <script src = "articles/main.js"></script>

</html>
