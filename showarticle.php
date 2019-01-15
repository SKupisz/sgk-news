<?php
session_start();
if(!isset($_GET['id']))
{
  header("Location: index.php");
  exit();
}
$id = $_GET['id'];
$test_id = (int)$id;
if($id != $test_id)
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
    $rezultat = $polaczenie->query("UPDATE sent_articles SET views = views+1 WHERE id = $id");
    if(!$rezultat) throw new Exception($polaczenie->error);
  }
} catch (Exception $e) {
  $connection = 0;
}

?>
<!DOCTYPE html>
<html lang = "pl">
  <head>
    <meta charset="utf-8"/>
      <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
      <link rel = "stylesheet" type = "text/css" href = "top/show.css"/>
      <link rel="shortcut icon" type = "image/ico" href = "main/favicon.ico"/>
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
      ?><section id = "u10connectionfail">
        <header class = "u10cfheader">
          Ooops!...
        </header>
        <main id = "u10cfmain">
          Something went wrong. We cannot show this article right now. Try later.
        </main>
      </section><?php
    }
    else {
      ?>
      <section id = "u10connection">
        <header class = "u10cfheader">
          <?php
          echo $title;
          ?>
        </header>
        <main id = "u10cfmain">
          <?php echo $content;?>
        </main>
        <aside id = "u10cv">
          <?php
            if($views == 1)
            {
              ?> 1 view <?php
            }
            else {
              echo $views;?> views<?php
            }
          ?><br>
          <button id = "u10rl">
          </button>
        </aside>

      </section><?php
    }?>
  </main>
</body>

<script src = "main/main.js"></script>
<script src = "jquery-3-2-1.js"></script>
<script src = "top/options.js"></script>
</html>
