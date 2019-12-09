<?php
if(!isset($_GET['primDat']))
{
  header("Location: ../index.php");
  exit();
}
$alfa = $_GET['primDat'];
if(filter_var($alfa,FILTER_VALIDATE_EMAIL))
{
  $checkin = 1;
  $error = 0;
  require_once "../main/connect.php";
  try {
    $polaczenie = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_user,$db_password,
    [PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = $polaczenie->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindValue(":email",$alfa,PDO::PARAM_STR);
    $query->execute();
    if($query->rowCount() == 0)
    {
      $query = $polaczenie->prepare('SELECT * FROM admins WHERE email = :email');
      $query->bindValue(":email",$alfa,PDO::PARAM_STR);
      $query->execute();
      $row = $query->fetch();
      if($query->rowCount() == 0)
      {
        header("Location: ../login.php");
        exit();
      }
      else {
        $error = 0;
      }
    }
    else {
      $error = 0;
    }
  } catch (PDOException $e) {
    $error = 1;
  }

}
else {
  header("Location: ../login.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SGK-news</title>
    <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href = "../main/bar.css"/>
    <link rel = "stylesheet" href = "./authorize.css"/>
    <link rel="shortcut icon" type = "image/ico" href = "../main/logo.png"/>
    <meta name="description" content="SGK-news website">
    <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
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
    
    
</section>
    <section class = "container">
      <?php
      if($error == 1)
      {
        ?>
        <div class = "wrong">
          <header class = "wrongHeader">
            Ooops!!...
          </header>
          <article class = "wrongContent">
            Something went wrong. Refresh or try later
          </article>
        </div>
        <?php
      }
      else {
        ?>
        <div class = "newPassword">
          <header class = "newPasswordHeader">Choose a new password</header>
          <?php
          require_once "../inbox/encrypt.php";
          $ob = new Encrypt;
          $cypher = $ob->goWithIt($alfa);

          ?>
          <form method = "post" action = "changePassword.php?email=<?php echo $cypher;?>">
            <input type = "password" class = "passwordInput firstInput" name = "pass" placeholder="Type password here" required/>
            <div class = "passwordFirstInfo" id = "passwordFirstInfo"></div>
            <input type = "password" class = "passwordInput secondInput" name = "pass2" placeholder="Repeat password" required/>
            <div class = "passwordSecondInfo" id = "passwordSecondInfo"></div>
            <input type="submit" class = "passwordSubmit" value = "Change password"/>
          </form>
        </div>
        <?php
      }
      ?>
    </section>
  </body>
  <script src = "../main/jquery-3-2-1.js"></script>
  <script src="../main/main.js"></script>
  <script src = "resetMain.js"></script>
</html>
