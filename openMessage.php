<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
  header("Location: index.php");
  exit();
}
if(!isset($_GET['nmb']))
{
  header("Location: inbox.php");
  exit();
}
$alfa = $_GET['nmb'];
if(strlen($alfa) == 0)
{
  header("Location: ./inbox.php");
  exit();
}
for($i = 0; $i < strlen($alfa); $i++)
{
  if($alfa[$i] >'9' || $alfa[$i] < '0')
  {
    $_SESSION['e_post'] = "Incorrect data";
    header("Location: ./inbox.php");
    exit();
    break;
  }
}
$final = (int)$alfa;
$checkin = 1;
$connect = 1;
require_once "./main/connect.php";
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
      require_once "./inbox/decoding.php";
      $en = new Decode("./inbox/");
      $content = $en->toNormal($content);
    }
  }
} catch (Exception $e) {
  $connect = 0;
}

?>
<html>
<head>
  <meta charset="utf-8"/>
  <meta charset="utf-8"/>
  <meta name="viewport"  content="width=device-width, inital-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href = "main/bar.css"/>
  <link rel="stylesheet" type="text/css" href = "inbox/css/messageLayout.css"/>
  <link rel="shortcut icon" type = "image/png" href = "main/logo.png"/>
  <meta name="description" content="SGK-news website">
  <meta name="keywords" content="SGK-news, news, daily, buisness, politic,art,Simon Kupisz">
  <title> SGK-news </title>
</head>
<body>
<?php require_once "./main/bar.php" ?>
<main class = "umain">
  <?php if($connect == 1)
  {
    ?>  <header class = "welcome-header">
        Message
      </header>
      <section class = "from-header">
        From: <?php echo $from;?>
      </section>
      <section class = "title-header">
        Title: <?php echo $title;?>
      </section>
      <section class = "message-content">
        <?php echo $content;?>

      </section>
<?php
  }
  else {
    ?><section class = "error-section">
      Sorry, you cannot connect right now. Try later
    </section><?php
  }?>

</main>
</body>
</html>
