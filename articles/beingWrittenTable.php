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
  ?>"
  style = "position: absolute; top: <?php echo $i*7;?>%; left: 0px;">
<section id = "u11atrt">
  <?php echo $title1; ?>
  <label id = "u11atrtnext">
    <?php echo $title2; ?>
  </label>
</section>
<a href = "articles.php?sid=<?php echo $bwids[$i];?>" id = "u11atrcr">
  Continue<label class = "u11atrcrr"> writing</label>
</a>
<section id = "u11atrca">
  <form method = "post" action = "articles/confirmArticle.php">
    <input type = "hidden" name = "id" value = "<?php echo $bwids[$i];?>"/>
    <button type = "submit" id = "u11atrcas">
      Send<label class = "u11atrcrr"> an article</label>
    </button>
  </form>
</section>
<!--<div id = "u11atrmo" onclick="atrOpen();">
  Options
</div>
<section id = "u11atrresp">
  <a href = "articles.php?sid=<?php //echo $bwids[$i];?>" id = "u11atrcrr">
    Continue writing
  </a>
  <section id = "u11atrcar">
    <form method = "post" action = "articles/confirmArticle.php">
      <input type = "hidden" name = "id" value = "<?php //echo $bwids[$i];?>"/>
      <input type = "submit" id = "u11atrcas" value = "Send an article"/>
    </form>
  </section>
</section>-->
</section><?php
}
}
else {
  ?><div id = "u11anh">You are not writting any article right now</div><?php
}
?>
