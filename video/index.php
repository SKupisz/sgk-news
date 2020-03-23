<?php
  $barDir = "../";
  require_once "../src/video/logic/loadData.php";
?>
<!DOCTYPE html>
<html lang = "pl">
  <head>
    <meta charset="utf-8"/>
      <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href = "../main/bar.css"/>
      <link rel = "stylesheet" type = "text/css" href = "../top/main.css"/>
      <link rel = "stylesheet" type = "text/css" href = "../src/video/css/main.css"/>
      <link rel="shortcut icon" type = "image/png" href = "../logo.png"/>
      <meta name="description" content="SGK-news website">
      <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
      <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    <title>SGK news</title>
  </head>
<body>
  <?php require_once "../main/bar.php";?>
  <main id = "umain"> 
    <?php if($work == 1){
      require_once "../src/video/logic/videoSection.php";
    }?>

  </main>
</body>
<?php
if(isset($_SESSION["e_comment"])){
  ?><script>
    openTheAlert("Comment info",<?php echo $_SESSION["e_comment"];?>);
  </script><?php
  unset($_SESSION["e_comment"]);
}
?>
<script src = "../main/main.js"></script>
<script src="../src/node_modules/push.js/bin/push.min.js"></script>
<script src="../src/video/client/main.js"></script>
</html>