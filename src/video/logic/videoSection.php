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
    <section class="comments">
        <form action="../src/video/client/commentTheVideo.php?v=<?php echo $s;?>" method="post">
            <textarea type="text" name="comment-content" class="comment-input" required placeholder = "Your comment here..."></textarea>
            <button type="submit" class="send-comment">Comment</button>
        </form>
    </section>
    <section class="presenting-comments">
            <?php
                for($i = 0 ; $i < count($commentsContent); $i++){
                    ?>
                    <div class="comment-container">
                        <header class="comment-author"><?php echo $commentsAuthors[$i];?></header>
                        <div class="comment-content"><?php echo $commentsContent[$i];?></div>
                    </div>
                    <?php
                }
            ?>
    </section>
</section>
