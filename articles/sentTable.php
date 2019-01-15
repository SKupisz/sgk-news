<?php
if($slength > 0)
{


for($i = 0 ; $i < $slength; $i++)
{
  $title = $sarticles[$i];
  if(strlen($title) > 30)
  {

    if(strpos($title," "))
    {
      $title1 = "";
      $pos1 = 0;
      $title2 = "";
      while(strlen($title1) < 30)
      {
        $now = substr($title,$pos1,strlen($title));
        $pos = strpos($now," ");
        if($pos+$pos1 == $pos1)
        {
          break;
        }
        else {
          $pos1+=$pos;
          $title1 = substr($title,0,$pos1);
        }
      }
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
<section id = "u11atrr" onclick = "seeStatistic('<?php echo $title;?>',<?php echo $swords[$i];?>,<?php echo $sviews[$i];?>,<?php echo $snumber[$i];?>)">
  See statistic
</section>
</section><?php
}
}
else {
  ?><div id = "u11anh">You haven't sent any article yet</div><?php
}
?>
