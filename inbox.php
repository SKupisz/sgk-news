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
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "inbox/css/main.css"/>
  <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
<?php require_once "main/bar.php" ?>
<main id = "umain">
  <!--<div class = "apologising">
    Sorry, this section is temporary not aviable because of technical problems
  </div>-->
  
  <?php
  if($pass == 0)
  {
    ?><section class = "u9e"><span class = "u9ec">You are not signed in</span></section>
    <section class = "u10el">
      <a href = "login.php" class = "defaultLink notLoggedIn"><nav class = "u10elwrapper">Sign in</nav></a>
      <a href = "register.php" class = "defaultLink notLoggedIn"><nav class = "u10elwrapper">Register</nav></a>
    </section><?php
  }
  else if($connection == 0)
  {
    ?><section class = "u9e"><span class = "u9ec">Oops!...</span></section>
    <section class = "u10el">
      <nav class = "u10elwrapper">You cannot connect right now. Try later</nav></section><?php
  }
  else {
    ?>
    <header class = "u9t">
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
    <section class = "sectionRunners">
      <button class = "sectionButton goCheckTheBox">
        Check the emails
      </button>
      <button class = "sectionButton goWriteTheEmail">
        Write an email
      </button>
      <button class = "sectionButton goBlackListing">
        Black list
      </button>
    </section>
    <section class = "action-block box">
      <?php if($post == 0)
        {
          ?><section class = "u9crnone">There is no messages for you</section><?php
        }
        else {
          ?>      
          <nav class = "emails-desc">
          <div class = "emails-descItem from">
            From
          </div>
          <div class = "emails-descItem topic">
            Topic
          </div>
          <div class = "emails-descItem signAll">
            <div class = "checkbox-container">
             <input type = 'checkbox' id = "main-checkbox"/>
            </div>
          </div>
        </nav><?php
          $lt = count($content);
          for($i = 0 ; $i < $lt; $i++){
            $fr = $from[$i];
            $ti= $title[$i];
            $idn = $id[$i];
            ?>
        <div class = "email-row">
          <div class = "email-rowItem from">
            <?php echo $fr; ?>
          </div>
          <div class = "email-rowItem topic">
            <?php echo $ti; ?>
          </div>
          <div class = "email-rowItem signAll">
            <div class = "checkbox-container">
             <input type = 'checkbox' id = "message<?php echo $ti; ?>" class = "subCheckbox"/>
            </div>
          </div>
        </div><?php
          }
        }
          ?>
    </section>
    <section class = "action-block writing">
      <header class = "writing-header">
        Writing an email
      </header>
      <form method = "post" action = "./inbox/sendAMessage.php">
        <div class = "writing-Item receiver">
          <div class = "writingInput-desc">To:  </div>
          <input type = "text" name = "receiver" class = "email-input"/>
        </div>
        <div class = "writing-Item topic">
          <div class = "writingInput-desc">Topic:  </div>
          <input type = "text" name = "topic" class = "email-input"/>
        </div>
        <textarea name = "content" class = "email-mainContent"></textarea>
        <button class = "confirm-button" type = "submit">Send</button>
      </form>
    </section>
    <section class = "action-block blacklist">
      <section class = "choosing-mode">
        <button class = "choosing-buttons list">Your list</button>
        <button class = "choosing-buttons block">Block a user</button>
      </section>
      <section class = "blacklistMood-container userList">
      <?php
      $lt = count($names);
      if($lt == 0)
      {
        ?><section class = "u9cblnone">There is no user on your black list</section><?php
      }
      else {
        if($lt <= 30)
        {
          for($i = 0 ; $i < $lt; $i++)
          {
            $name = $names[$i];
            $date = $dates[$i];
            $numId = $ids[$i];
            ?>
                    <div class = "email-row">
          <div class = "email-rowItem from">
            <?php echo $fr; ?>
          </div>
          <div class = "email-rowItem topic">
            <?php echo $ti; ?>
          </div>
          <div class = "email-rowItem signAll">
            <div class = "checkbox-container">
             <input type = 'checkbox' id = "message<?php echo $ti; ?>" class = "subCheckbox"/>
            </div>
          </div>
        </div><?php
          }
        }
      }?>
      </section>
      <section class = "blacklistMood-container blockingForm">
      <header class = "blocking-header">
        Blocking a user
      </header>
      <form method = "post" action = "./inbox/sendAMessage.php">
        <div class = "blocking-Item receiver">
          <div class = "blockingItem-desc">Username:  </div>
          <input type = "text" name = "usernameToBlock" class = "blocking-input"/>
        </div>
        <button class = "confirm-button" type = "submit">Block</button>
      </form>
      </section>
    </section>
    <?php
  }
  ?>

</main>
</body>
<script src = "main/jquery-3-2-1.js"></script>
<script src="main/main.js"></script>
<script src="inbox/main.js"></script>
</html>
