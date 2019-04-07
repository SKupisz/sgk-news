<?php
session_start();
if(!isset($_POST['u11femail']))
{
  $content = 1;
}
else {
  $alfa = $_POST['u11femail'];
  if(filter_var($alfa,FILTER_VALIDATE_EMAIL))
  {
    mail($alfa,"Recovering the SGK-news password","Hello,
    Your password reset link is http://localhost/sgk-news/login/authorizeReset.php?primDat=".$alfa."
    Ignore it if you did not ask for a reset");
    $content = 2;
  }
  else {
    $content = 1;
    $error = "Wrong e-mail address";
  }
}
?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "../main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "forgot.css"/>
  <link rel="shortcut icon" type = "image/png" href = "../main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
  <section id = "u1">
    <a href = "index.php" id = "u2">
      <img src="../main/logo.png" alt="logo" id = "u2i"/>
    </a>
    <button id = "upanelopen">
      Menu
    </button>
    <label id = "upanelofical">
    <a href = "../top.php" id = "u3">
      <nav class = "menDescLower">Top articles</nav>
    </a>
    <a href = "../articles.php" id = "u4">
      <nav class = "menDescLower">Your articles</nav>
    </a>
    <a href = "../inbox.php" id = "u5">
      <nav class = "menDesc">Inbox</nav>
    </a>
    <a href = "../about.php" id = "u6">
      <nav class = "menDesc">About us</nav>
    </a>
    <?php if(isset($_SESSION['zalogowany']))
    {
      ?>
      <a href = "../settings.php" id = "u7">
        <nav class = "menDesc">Settings</nav>
      </a>
      <a href = "../profile.php" id = "u8">
        <nav class = "menDesc">Profile</nav>
      </a>
      <a href = "../logout.php" id = "u9d">
        <nav class = "menDesc">Logout</nav>
      </a><?php
    }
    else{?>
    <a href = "../login.php" id = "u7">
      <nav class = "menDesc">Sign in</nav>
    </a>
    <a href = "../register.php" id = "u8">
      <nav class = "menDesc">Sign up</nav>
    </a>
  <?php }?>
  </label>
    <label id = "upanel">
    <a href = "../top.php" id = "u3">
      Top articles
    </a>
    <a href = "../articles.php" id = "u4">
      Your articles
    </a>
    <a href = "../inbox.php" id = "u5">
      Inbox
    </a>
    <a href = "../about.php" id = "u6">
      About us
    </a>
    <?php if(isset($_SESSION['zalogowany']))
    {
      ?>
      <a href = "../settings.php" id = "u7">
        Settings
      </a>
      <a href = "../profile.php" id = "u8">
        Profile
      </a>
      <a href = "../logout.php" id = "u9d">
        Logout
      </a><?php
    }
    else{?>
      <a href = "../login.php" id = "u7">
        Sign in
      </a>
      <a href = "../register.php" id = "u8">
        Sign up
      </a>
  <?php }?>
  </label>
  </section>

<section id = "umain">

  <header class = "u10t">
    Recovering password
  </header>
  <main class = "u11f">
    <?php if($content == 1)
    {
      if(isset($error))
      {
        echo $error;
      }
      else {
        ?>Enter your email, and we will send you email with your new password<?php
      }
      ?>
      <form method = "post" action="">
        <input type = "email" <?php if(isset($alfa)){echo "value = '".$alfa."'";}?> name = "u11femail" class = "u11femail" placeholder="Enter your email here..." required/>
        <button type = "submit" class = "u11fsub" id = "u11fsub">
          Send password reset email
        </button>
      </form>
      <?php
    }
    else {
      ?><div class = "u11done">Your request has just been sent</div>
      <a href = "../login.php">
        <button class = "u11fsub" id = "u11fsub">
          Go back
        </button>
      </a><?php
    }?>

  </main>
</section>
</body>
<script src = "../main/jquery-3-2-1.js"></script>
<script src="../main/main.js"></script>
</html>
