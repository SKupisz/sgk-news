<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  $pass = 0;
}
else {
  $pass = 1;
  require_once "inbox/loadData.php";
}

?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "inbox/main.css"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel = "stylesheet" type="text/css" href = "inbox/blMain.css"/>
  <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
<?php require_once "main/bar.php" ?>
<main id = "umain">

  <?php
  if($pass == 0)
  {
    ?><section id = "u9e"><span id = "u9ec">You are not signed in</span></section>
    <section id = "u10el">
      <a href = "login.php" class = "defaultLink notLoggedIn"><nav class = "u10elwrapper">Sign in</nav></a>
      <a href = "register.php" class = "defaultLink notLoggedIn"><nav class = "u10elwrapper">Register</nav></a>
    </section><?php
  }
  else if($connection == 0)
  {
    ?><section id = "u9e"><span id = "u9ec">Oops!...</span></section>
    <section id = "u10el">
      <nav id = "u10elwrapper">You cannot connect right now. Try later</nav></section><?php
  }
  else {
    ?>
    <header id = "u9t">
      <?php if(isset($_SESSION['e_mailing']))
      {
        echo $_SESSION['e_mailing'];

      }
      else if(isset($_SESSION['e_post']))
      {
        echo $_SESSION['e_post'];
      }
      else if(isset($_SESSION['e_bladd']))
      {
        echo $_SESSION['e_bladd'];
        unset($_SESSION['e_bladd']);
      }
      else if(isset($_SESSION['delError']))
      {
        echo $_SESSION['delError'];
        unset($_SESSION['delError']);
      }
      else {
        ?>Inbox<?php
      }?>
    </header>
    <section id = "u9m">
      <button id = "u9mr">Recive</button>
      <button id = "u9mw">Write</button>
      <button id = "u9mbl">Black list</button>
    </section>
      <section id = "u9cr">
        <?php if($post == 0)
        {
          ?><section id = "u9crnone">There is no messages for you</section><?php
        }
        else {
          ?>

          <section id = "u9crms"></section>
            <?php
              $lt = count($content);
              if($lt <= 15)
              {
                for($i = 0; $i < $lt; $i++)
                {
                  $fr = $from[$i];
                  $ti= $title[$i];
                  $idn = $id[$i];
                  ?><section id = "u9crms" class = "u9c1" style="position: absolute; top: <?php echo 10+(($i+1)*5);?>%;left: 0px; " >
                    <span id = "u9crmf" onclick = "goToReader(<?php echo $idn?>);"><?php echo $fr;?></span>
                    <span id = "u9crmt" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $ti;?></span>
                    <span id = "u9crmun"><input type="checkbox" class = "u9crmsch" onclick = "addToList(<?php echo $idn;?>);"/></span>
                  </section><?php
                }
                $two = $lt;
              $to = 0;

              }
              else {
                  $one = 0;
                  $two = 15;
                  for($i = $one; $i < $two; $i++)
                  {
                    $fr = $from[$i];
                    $ti = $title[$i];
                    $idn = $id[$i];
                    ?><section id = "u9crms" class = "1" style="position: absolute; top: <?php echo 10+(($i+1)*5);?>%;left: 0px; display: block;" >
                      <span id = "u9crmf" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $fr;?></span>
                      <span id = "u9crmt" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $ti;?></span>
                      <span id = "u9crmun"><input type="checkbox" class = "u9crmsch" onclick = "addToList(<?php echo $idn;?>);"/></span>
                    </section><?php
                  }
                  if($lt >= 30){

                      if($lt % 15 == 0)
                      {
                        $how_many = $lt/15;
                        for($j = 1; $j < $how_many; $j++)
                        {
                          for($i = $j*15; $i < $j*15+15; $i++)
                          {
                            $fr = $from[$i];
                            $ti = $title[$i];
                            $idn = $id[$i];
                            ?><section id = "u9crms" class = "<?php echo $j+1;?>" style="position: absolute; top: <?php echo 10+(($i-14)*5);?>%;left: 0px; display: none;" >
                              <span id = "u9crmf" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $fr;?></span>
                              <span id = "u9crmt" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $ti;?></span>
                              <span id = "u9crmun"><input type="checkbox" class = "u9crmsch" onclick = "addToList(<?php echo $idn;?>);"/></span>
                            </section><?php
                          }
                        }
                      }
                      else{
                        $how_many = ($lt-$lt%15)/15;
                        for($j = 1; $j < $how_many; $j++)
                        {
                          for($i = $j*15; $i < $j*15+15; $i++)
                          {
                            $fr = $from[$i];
                            $ti = $title[$i];
                            $idn = $id[$i];
                            ?><section id = "u9crms" class = "<?php echo $j+1;?>" style="position: absolute; top: <?php echo 10+(($i-14)*5);?>%;left: 0px; display: none;" >
                              <span id = "u9crmf" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $fr;?></span>
                              <span id = "u9crmt" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $ti;?></span>
                              <span id = "u9crmun"><input type="checkbox" class = "u9crmsch" onclick = "addToList(<?php echo $idn;?>);"/></span>
                            </section><?php
                          }
                        }
                        for($i = $how_many*15; $i < $lt; $i++)
                          {
                            $fr = $from[$i];
                            $ti = $title[$i];
                            $idn = $id[$i];
                            ?><section id = "u9crms" class = "<?php echo $how_many+1;?>" style="position: absolute; top: <?php echo 10+(($i-$how_many*15+1)*5);?>%;left: 0px; display: none;" >
                              <span id = "u9crmf" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $fr;?></span>
                              <span id = "u9crmt" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $ti;?></span>
                              <span id = "u9crmun"><input type="checkbox" class = "u9crmsch" onclick = "addToList(<?php echo $idn;?>);"/></span>
                            </section><?php
                          }

                      }
                      $to = 0;
                  }
                  else {
                    for($i = $two; $i < $lt; $i++)
                    {
                      $fr = $from[$i];
                      $ti = $title[$i];
                      $idn = $id[$i];
                      ?><section id = "u9crms" class = "2" style="position: absolute; top: <?php echo 10+(($i-$two+1)*5);?>%;left: 0px; display: none;" >
                        <span id = "u9crmf" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $fr;?></span>
                        <span id = "u9crmt" onclick = "goToReader(<?php echo $idn;?>);"><?php echo $ti;?></span>
                        <span id = "u9crmun"><input type="checkbox" class = "u9crmsch" onclick = "addToList(<?php echo $idn;?>);"/></span>
                      </section><?php
                    }
                    $to = 0;
                  }
              }
?>
              <section id = "u9crm" class = "u9c3" style="position: absolute; top: 1px; left: 0px; ">
                <button id = "u9crmf1" class = "u9crmmt"><label class = "resp">Sign as </label>unreaded</button>
                <button id = "u9crmt1" ><label class = "resp">Move </label>to trash</button>
                <span class = "u9crma" id ="crma1" onclick = "left();"><</span>
                <span class = "u9crma" id ="crma2"  onclick = "right();">></span>
              </section>

          </section><?php
        }?>
      </section>
      <section id = "u9cw">
        <main id = "u9cwm">
          <form method="post" action="sendAMessage.php">
          <section id = "u9cwt"><!--<span id = "u9cwtx"> To ≫ </span>-->
            <input type="text" name = "u9mr" id = "u9crc" required placeholder="To"
            <?php if(isset($_SESSION['e_reciver']))
            {
              ?>value="<?php echo $_SESSION['e_reciver'];?>"<?php
              unset($_SESSION['e_reciver']);
            }?>/>
          <!--<span id = "u9cwtx2"> Title ≫ </span>-->
          <input type="text" name = "u9mt" id = "u9crc2" required placeholder="Title" <?php if(isset($_SESSION['e_title']))
          {
            ?>value="<?php echo $_SESSION['e_title'];?>"<?php
            unset($_SESSION['e_title']);
          }?>/>
        </section>
          <section id = "u9cwc">
             <textarea name="u9mc" id = "u9mc" required><?php if(isset($_SESSION['e_content']))
                          {
                            echo $_SESSION['e_content'];
                            unset($_SESSION['e_content']);
                          }
                          else {
                            ?><?php
                          }?></textarea>
           </section>
           <input type="submit" value="Send a message" id = "u9ms"/>
        </form>
        </main>
      </section>
      <section id = "u9cbl">
        <?php require_once "inbox/blackListIndex.php"?>
      </section>

    <section id = "u9l">
    </section>
    <aside id = "u9l">
    </aside>
    <?php
  }
  ?>
</main>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
<script src="inbox/main.js"></script>
<?php if(isset($_SESSION['e_mailing']))
{
  ?><script>runPostForm();</script><?php
  unset($_SESSION['e_mailing']);
}
if(isset($_SESSION['e_post']))
{
  ?><script>runPostBox();</script>
  <?php unset($_SESSION['e_post']);
}?>
</html>
