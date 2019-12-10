<?php
  for($i = 0; $i < $howManyImages; $i++)
  {
    $nowLocalization = substr($imagesAddress[$i],6,strlen($imagesAddress[$i]));
    $name = substr($nowLocalization,15,strlen($nowLocalization)-19);
    $author = $imagesFrom[$i];
    $nowLikes = $imagesLikes[$i];
    $nowId = $imagesId[$i];
    $class = "imageContainer";
    if($i > 0)
    {
      $class.=" anotherImageContainer";
    }
    ?>
    <section class = "<?php echo $class; ?>" id = <?php echo "imageId".$nowId;?>>
      <figure class = "imageFigure">
      <img src = "<?php echo $nowLocalization; ?>" alt = "image" class = "showingImage"/>
      <figcaption class="imageCaption">
        <label class = "imageTitle"><?php echo $name;?></label><?php echo " by ".$author;?></figcaption>
    </figure>
    <aside class = "imageAccesories">
      <div class = "imageLikes">
          <button class = "imageSumbitButton" type="submit" name = "imageSumbitButton" onclick = "sendImageLike(<?php echo $nowId; ?>)">
        <img src = "top/likes/like.png" alt = "like" class = "like-image"/>
      </button>
        <label class = "likesQuantity" id = "quantity<?php echo $nowId;?>"><?php echo $nowLikes;?></label>
      </div>
    </aside>
    </section><?php
  }
?>
<section class = "choosing-bar">
  <a href = "?n=<?php if($number-10 >= 0) {echo $number-10;} else {echo '0';} ?>
  ">
  <button class="choosing-bar-item left-item"><</button>
  </a>
  <a href = "?n=<?php if($flag == 0){echo $number+10;} else { echo $number; }?>">
  <button class="choosing-bar-item right-item">></button>
</a>
</section>
