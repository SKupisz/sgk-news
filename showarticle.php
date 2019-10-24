<?php
session_start();
if(!isset($_GET['id']))
{
  header("Location: index.php");
  exit();
}
$id = $_GET['id'];
$test_id = (int)$id;
if($id != $test_id || $id < 0)
{
  header("Location: index.php");
  exit();
}
$checkin = 1;
require_once "main/connect.php";
$connection = 1;
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $likes = 0;
    if(isset($_SESSION['liking_error']))
    {
      unset($_SESSION['liking_error']);
    }
    $rezultat = $polaczenie->query("SELECT tags FROM sent_articles WHERE id = $id");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 0)
    {
      mysqli_close($polaczenie);
      header("Location: ../../");
      exit();
    }
    $row = $rezultat->fetch_assoc();
    $tags = $row['tags'];
    $rezultat = $polaczenie->query("SELECT likes FROM sent_articles WHERE id = $id");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 0)
    {
      mysqli_close($polaczenie);
      header("Location: ../../");
      exit();
    }
    $row = $rezultat->fetch_assoc();
    $likes = $row['likes'];
    if(!isset($_SESSION['liking']) && !isset($_SESSION['comment_done']))
    {
      $rezultat = $polaczenie->query("UPDATE sent_articles SET views = views+1 WHERE id = $id");
      if(!$rezultat) throw new Exception($polaczenie->error);

    }
    $comments = $polaczenie->query("SELECT * FROM sent_comments WHERE postId = $id");
    if(!$comments) throw new Exception($polaczenie->error);
    if($comments->num_rows == 0)
    {
      $noComments = 1;
    }
    else {
      $noComments = 0;
      $fromCom = array();
      $contentsCom = array();
      $len = $comments->num_rows;
      for($i = 0 ; $i < $len; $i++)
      {
        $row = $comments->fetch_assoc();
        $fromCom[$i] = $row['username'];
        $contentsCom[$i] = $row['content'];
      }
      $fromCom = array_reverse($fromCom);
      $contentsCom = array_reverse($contentsCom);
    }
    mysqli_close($polaczenie);

  }
} catch (Exception $e) {
  $connection = 0;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
      <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
      <link rel = "stylesheet" type = "text/css" href = "top/show.css"/>
      <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
      <meta name="description" content="SGK-news website">
      <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    <title>SGK news</title>
    <?php require_once"top/loadShowingData.php"?>
  </head>
<body>
  <?php require_once "main/bar.php";?>
  <main id = "umain">
    <?php
    if($connection == 0)
    {
      ?><section class = "u10connectionfail">
        <header class = "u10cfheader">
          Ooops!...
        </header>
        <main class = "u10cfmain">
          Something went wrong. We cannot show this article right now. Try later.
        </main>
      </section><?php
    }
    else {
      ?>
      <section class = "u10connection">
        <header class = "u10cfheader">
          <?php
          echo $title;
          ?>
        </header>
        <main class = "u10cfmain">
          <?php echo $content;?>
        </main>
        <aside class = "u10cv">
          <?php
            if($views == 1)
            {
              ?> 1 view <?php
            }
            else {
              echo $views;?> views<?php
            }
            if(isset($_SESSION['zalogowany']))
            {
              ?><br>

              <a href = "top/likes/like.php?aid=<?php echo $id;?>">
                <button id = "u10rl">
                </button>
              </a>
              <div class = "u10lq">
                <?php echo $likes;?>
              </div><?php
            }?>
            <div class = "u10tq">
              <?php if(strlen($tags) == 0){
                ?>No tags<?php
              }
              else {
                ?>Tags: <?php echo $tags;
              }?>
            </div>
            <?php
          ?>
        </aside>
        <section class = "comments">
          <form method = "post" action = "top/sendCom.php?postId=<?php echo $id;?>">
            <textarea class = "commentContent" name = "content" placeholder="Write your comment here"></textarea>
            <button class = "commentSubmit" type = "submit">Send comment</button>
          </form>

        </section>
        <section class = "comments showingComments">
          <?php
          if($noComments == 1)
          {
            ?>
            <label class = "noCommentHere">No Comments</label><?php
          }
          else {
            $lt = count($contentsCom);
            for($i = 0 ; $i < $lt; $i++)
            {
              $nowFrom = $fromCom[$i];
              $nowContent = $contentsCom[$i];
              ?><section class = "commentContainer">
                <div class = "commentFrom">
                  <label <?php if(isset($_SESSION['zalogowany']) && $nowFrom == $_SESSION['zalogowany']) echo 'class = "yourComment"';?>>
                    <?php echo $nowFrom;?>
                  </label>
                </div>
                <div class = "commentContentNow"><?php echo $nowContent;?>
                </div>
              </section><?php
            }
          }
          ?>
        </section>
      </section>


    <?php
  }?>
  </main>
</body>
<?php if(isset($_SESSION['liking'])|| isset($_SESSION['comment_done'])) {
  ?><script>window.scrollTo(0,document.querySelector("#u10cfmain").scrollHeight);</script><?php
  unset($_SESSION['liking']);
  unset($_SESSION['comment_done']);
}?>
<script src = "main/jsLibrarys/push.js"></script>
<script src = "main/main.js"></script>
<script src = "jquery-3-2-1.js"></script>
<script src = "top/options.js"></script>
<script>
document.querySelector(".showingComments").top = window.innerHeight;
</script>
<?php
if(isset($_SESSION['commentError']))
{
  ?><script>failedComment();</script><?php
  unset($_SESSION['commentError']);
}?>
</html>
