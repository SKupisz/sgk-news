<?php
session_start();
require_once "./src/bulletin/loadData.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
      <link rel = "stylesheet" type = "text/css" href="src/bulletin/css/main.css"/>
      <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
      <meta name="description" content="SGK-news website">
      <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
    <title>SGK news</title>
  </head>
  <body>
    <?php require_once "main/bar.php";?>
    <main class = "umain">
        <?php
        if($isConnection == 0){
            ?>
                <section class="connect-error">
                    <header class="error-header">Something went wrong</header>
                    <div class="error-content">You cannot connect right now. Try later</div>
                </section>
            <?php
        }
        else{
            ?><header class="welcome-header">Service bulletin</header><?php
            for($i = 0 ;$i < $howMany; $i++){
                $row = $rows[$i];
                ?>
                    <section class="content-container">
                        <div class="bull-container">
                            <header class="bull-header"><?php echo $row["title"];?></header>
                            <div class="bull-desc"><?php echo $row["content"];?></div>
                        </div>
                    </section>
                <?php
            }
        }
        ?>
    </main>

  </body>
  <script src="./src/node_modules/push.js/bin/push.min.js"></script>
  <script src = "main/jquery-3-2-1.js"></script>
  <script src = "main/main.js"></script>
</html>
