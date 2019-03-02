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
    <link rel="shortcut icon" type = "image/ico" href = "../main/favicon.ico"/>
    <meta name="description" content="SGK-news website">
    <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  </head>
  <body>
    <section id = "u1">
      <a href = "index.php" id = "u2">
        <img src="../noweLogo2.png" alt="logo" id = "u2i"/>
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
