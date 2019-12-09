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
      <figcaption class="imageCaption"><?php echo $name." by ".$author;?></figcaption>
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
