<section class="playing-container">
    <video class = "video" controls <?php if($image != ""){?>poster = "<?php echo $image;?>"<?php }?>>
        <source src = "../src/video/client/loadTheVideo.php?s=<?php echo $_GET["s"];?>" type = "video/<?php echo $format;?>">
    </video>
    <header class="video-title"><?php echo $title;?></header>
    <footer class="video-author">by <?php echo $author;?></footer>
    <div class="likes-section">

        <div class="views-container">
            <div class="eye-container">👁</div>
            <span class="views-quantity"><?php echo $views;?></span>
        </div>
        <div class="likes-container">
            <button class="like-button" onclick = "sendVideoLike(<?php echo $s;?>)">✔</button>
            <span class="likes-quantity"><?php echo $likes;?></span>
        </div>
        <div class="dislikes-container">
            <button class="dislike-button" onclick = "sendVideoDislike(<?php echo $s;?>)">🤦‍♂️</button>
            <span class="dislikes-quantity"><?php echo $dislikes;?></span>
        </div>

    </div>
</section>
