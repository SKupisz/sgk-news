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
<ul id = "upanel">
  <li class="image_li"><a href="../index.php"><img id="logo" src="../logo.png"></a></li>  
  <li class = "navOpening">
    <span></span>
    <span></span>
    <span class = "theLastOne"></span>
  </li>
  <section class = "links-container">
  <li class="left_li"><a href = "../top.php" class="navlink">
      Articles
  </a></li>
  
  <li class="left_li"><a href = "../about.php" class="navlink">
      About us
  </a></li>
    
      
  <?php if(isset($_SESSION['zalogowany']))
  {
    ?>
    <li class="left_li"><a href = "../articles.php"class="navlink">
        Your articles
  </a></li>
    <li class="left_li"><a href = "../inbox.php" class="navlink">
        Inbox
  </a></li>
  <li class="right_li"><a href = "../logout.php" class="navlink">
        Logout
    </a></li>
    <li class="right_li"><a href = "../profile.php" class="navlink">
        Profile
    </a></li>
    <li class="right_li"><a href = "../settings.php" class="navlink">
        Setting
    </a></li><?php
  }
  else{?>
    <li class="right_li"><a href = "../login.php" class="navlink">
        Sign in
    </a></li>
    <li class="right_li"><a href = "../register.php" class="navlink">
        Sign up
    </a></li>
<?php }?>
  </section>
</ul>

<section id = "umain">

  <header class = "u10t">
    Recovering password
  </header>
  <main class = "u11f">
    <div class = "describe">
    <?php if($content == 1)
    {
      if(isset($error))
      {
        echo $error;
      }
      else {
        ?>Enter your email, and we will send you email with your new password<?php
      }
      ?></div>
      <form method = "post" action="">
        <div class = "inputWrapper">
          <input type = "email" <?php if(isset($alfa)){echo "value = '".$alfa."'";}?> name = "u11femail" class = "u11femail" placeholder="Enter your email here..." required/>
        </div>
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
