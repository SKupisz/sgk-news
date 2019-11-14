<link rel = "stylesheet" type = "text/css" href = "articles/main.css"/>

<?php
if($bwlength > 0)
{


for($i = 0 ; $i < $bwlength; $i++)
{
  $title = $bwtitles[$i];
  if(strlen($title) > 30)
  {
    $base = explode(" ",$title);
    if(count($base))
    {
      $title1 = "";
      $pos1 = 0;
      $title2 = "";
      $j = 0;
      while(strlen($title1) < 30 && $j < count($base))
      {

        if(strlen($title1.$base[$j]." ") < 30)
        {
          $title1.=$base[$j]." ";
        }
        else {
          break;
        }
        $j++;
      }
      $title1 = substr($title1,0,strlen($title1)-1);
      $title2 = "...";
    }
    else {
      $title1 = substr($title,0,30);
      $title2 = "";
    }

  }
  else {
    $title1 = $title;
    $title2 = "";
  }
  ?><section id = "u11atr" class = "<?php
  if($i%2 == 0)
  {
    ?>u11atr1<?php
  }
  else {
    ?>u11atr2<?php
  }
  ?>">
<section id = "u11atrt">
  <?php echo $title1; ?>
  <label id = "u11atrtnext">
    <?php echo $title2; ?>
  </label>
</section>
<section class = "u11optionsContainer">
<a href = "articles.php?sid=<?php echo $bwids[$i];?>" id = "u11atrcr">
  <button class = "u11atrcrBtn">
  <label class = "nonResponsive">Continue</label>
  <label class = "onResponsive">
  <img src = "articles/writing.png" class = "onResponsiveIcon"/></label>
</button>
</a>
<section id = "u11atrca">
  <form method = "post" action = "articles/confirmArticle.php">
    <input type = "hidden" name = "id" value = "<?php echo $bwids[$i];?>"/>
    <button type = "submit" id = "u11atrcas">
      Send
    </button>
  </form>
</section>
<section class = "u11delArt">
  <form method = "post" action = "articles/delArticle.php">
    <input type = "hidden" name = "id" value = "<?php echo $bwids[$i];?>"/>
    <button type = "submit" class = "u11delArtSumbit nonResponsive">
      Delete
    </button>
    <button type="submit" class = "u11delArtSumbit onResponsive">
        <img src = "articles/delete.png" class = "onResponsiveIcon"/>
    </button>
  </form>
</section>
</section>
</section><?php
}
}
else {
  ?><div id = "u11anh">You are not writting any article right now</div><?php
}
?>
