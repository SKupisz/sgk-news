<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
  exit();
}
if(!isset($_GET['nmb']))
{
  header("Location: ../inbox.php");
  exit();
}
$alfa = $_GET['nmb'];
if(strlen($alfa) == 0)
{
  header("Location: ../inbox.php");
  exit();
}
for($i = 0; $i < strlen($alfa); $i++)
{
  if($alfa[$i] >'9' || $alfa[$i] < '0')
  {
    $_SESSION['e_post'] = "Incorrect data";
    header("Location: ../inbox.php");
    exit();
    break;
  }
}
$final = (int)$alfa;
$checkin = 1;
$connect = 1;
require_once "../main/connect.php";
try {
  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  if($polaczenie->connect_errno != 0)
  {
    throw new Exception($polaczenie->connect_error);
  }
  else {
    $post = $_SESSION['zalogowany']."_post";
    $rezultat = $polaczenie->query("SELECT * FROM $post WHERE id = $final");
    if(!$rezultat) throw new Exception($polaczenie->error);
    if($rezultat->num_rows == 0)
    {
      mysqli_close($polaczenie);
      $_SESSION['e_post'] = "Incorrect data";
      header("Location: index.php");
      exit();
    }
    else {
      $row = $rezultat->fetch_assoc();
      $from = $row['fromm'];
      $content = $row['message'];
      $title = $row['title'];
      mysqli_close($polaczenie);
      require_once "encrypt.php";
      $en = new Encrypt;
      $content = $en->goBack($content);
      $content = substr($content,0,strlen($content)-1);
    }
  }
} catch (Exception $e) {
  $connect = 0;
}

?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel = "stylesheet" type="text/css" href = "messageLayout.css"/>
  <link rel="shortcut icon" type = "image/ico" href = "../main/favicon.ico"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
<main id = "umain">
  <?php if($connect == 1)
  {
    ?>  <header id = "u9h">
        Message
      </header>
      <section id = "u10f">
        From: <?php echo $from;?>
      </section>
      <section id = "u10t">
        <?php echo $title;?>
      </section>
      <section id = "u11m">
        <?php echo $content;?>

      </section>
      <section id = "u12l">
        <a href = "../inbox.php" id = "u12lg"><label class = "resp">Go </label>back</a>
        <a href = "../index.php" id = "u12li"><img src = "../noweLogo2.png" alt = "Main site" id = "u12liimg"/></a>
        <a href = "../topArticles.php" id = "u12la">Top articles</a>
        <a href = "../profile.php" id = "u12lp">Profile</a>
      </section>
<?php
  }
  else {
    ?><section id = "u9e">
      Sorry, you cannot connect right now. Try later
    </section><?php
  }?>

</main>
</body>
</html>
