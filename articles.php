<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: login.php");
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
      <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
      <meta name="description" content="SGK-news website">
      <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    <title>SGK news</title>
  </head>
  <body>
    <?php require_once "main/bar.php";?>
    <main class = "umain">
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
          <?php if(isset($_SESSION['e_artc']))
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
          <div id = "u11a" onclick = "beingWrittenOpen();"><p class="paddingtoptext">Waiting room</p></div>
        <div id = "u11s" onclick = "sentOpen();"><p class="paddingtoptext">Sent</p></div>
          <div id = "u11w" onclick = "writingOpen();"><p class="paddingtoptext">Write<label class = "u11wasr"> an article</label></p></div>
      </section>
      <section id = "u11projects">
        <section id = "u11asection" <?php if(isset($_SESSION['uploadImageFail'])) echo "style='display: none;'";?>>
          <?php require_once "articles/beingWrittenTable.php";?>
        </section>
        <section id = "u11ssection" <?php if(isset($_SESSION['uploadImageFail'])) echo "style='display: none;'";?>>
          <?php require_once "articles/sentTable.php"; ?>
        </section>
        <section id = "u11csection" <?php if(isset($_SESSION['uploadImageFail'])) echo "style='display: none;'";?>>
        </section>
        <section id = "u11wsection" <?php if(isset($_SESSION['uploadImageFail'])) echo "style='display: block;'";?>>
          <div class = "changeContainer">
            <div class = "changingMode bar1 now" id = "bar1">Article</div>
            <div class = "changingMode bar2" id = "bar2">Image</div>
            <div class = "changingMode bar3" id = "bar3">Sound</div>
          </div>
          <form method = "post" action = "articles/sendAnArticle.php" class = "sendingArticle">

            <section id = "u11wti"><p class="articletitle">Title </p><input type = "text" name = "u11wti" class = "titleInput" required value = "<?php if($sid != -1){
              echo $sidname;
            }?>"/></section>
            <section id = "u11wta">
                <div class = "u11wtadesc"><p class="articletitle">Article content</p></div>
              <textarea class = "u11wtai" name = "u11wtai" placeholder="Write here..." required><?php if($sid != -1){  echo $sidcontent;}?></textarea>
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
            <button type = "submit" name = "to_waiting" id = "u11was">
               Send<span class = "u11wasr"> an article</span> to waiting room
            </button>
            <?php if(!isset($_GET["sid"])){?>
            <button type = "submit" name = "to_public" id = "u11was">
               Send<span class = "u11wasr"> an article</span> to public
            </button><?php
            }?>

          </form>
          <form method = "post" action = "articles/uploadingSupport/uploadImage.php" enctype="multipart/form-data" class = "imageUpload">
            <section class = "postHeader">
              Title of image <input type = "text" name = "imageTitle" class = "titleInput" required/>
            </section>
            <main class = "mainUploadSection">
              <input type = "file" name = "fileToUpload" class = "forUpload" style = "display: none;"/>
              <input type="button" value="Browse..." class = "forUploadBtn" onclick="document.querySelector('.forUpload').click();" />
              <section class = "submitSection">
              <input name = "submit" type="submit" class = "uploadSubmitButton" value = "Send this photo to public"/>
            </section>
            </main>
          </form>
          <form method = "post" action = "articles/uploadingSupport/postSound.php" enctype="multipart/form-data" class = "soundUpload">
            <section class = "postHeader">
              Title of sound <input type = "text" name = "title" class = "titleInput" required/>
            </section>
            <main class = "mainUploadSection">
              <input type = "file" name = "fileToUpload" class = "soundForUpload" style = "display: none;"/>
              <input type="button" value="Browse..." class = "forUploadBtn" onclick="document.querySelector('.soundForUpload').click();" />
              <section class = "submitSection">
              <input name = "submit" type="submit" class = "uploadSubmitButton" value = "Send this sound to public"/>
            </section>
            </main>
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
  <script src="./src/node_modules/push.js/bin/push.min.js"></script>
  <script src = "main/jquery-3-2-1.js"></script>
  <script src = "main/main.js"></script>
  <script src = "articles/main.js"></script>
  <script>
    <?php if(isset($_SESSION['uploadImageFail']) || isset($_SESSION['e_art']) || isset($_SESSION['deletingError']) || isset($_SESSION["e_artc"]))
    {
      ?>
      openTheAlert("Articles Information","<?php
      if(isset($_SESSION['uploadImageFail'])){
        echo $_SESSION['uploadImageFail'];
        unset($_SESSION['uploadImageFail']);
      }
      else if(isset($_SESSION["e_art"])){
        echo $_SESSION["e_art"];
        unset($_SESSION['e_art']);
      }
      else if(isset($_SESSION["deletingError"])){
        echo $_SESSION["deletingError"];
        unset($_SESSION["deletingError"]);
      }
      else{
        echo $_SESSION["e_artc"];
        unset($_SESSION["e_artc"]);
      }
      ?>");<?php
    }
    if($sid != -1)
    {
      ?>writingOpen();<?php
    }
  ?> 

  </script>
</html>
