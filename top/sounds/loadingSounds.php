<section class = "u13">
      <section class = "u13wrapper">
            <div class="sub-navbar multimedia-navbar">
              <button class="multimedia-navItem sound-item">Music & Sounds</button>
              <button class="multimedia-navItem video-item">Videos</button>
            </div>  
            <section class="sounds-container">
            <?php 
              if($ifSounds == 0){
                ?><div class="no-sounds">
                  <header class="no-soundsHeader">Sorry, there is no sounds uploaded</header>
                  <footer class="no-soundsFooter">Try later</footer>
                </div><?php
              }
              else{
                $last = -1;
                $randMax = 4;
                for($i = 0 ;$i < count($soundId); $i++){
                  $soundIdTemp = $soundId[$i];
                  $soundName = $soundtitle[$i];
                  $soundauthor = $soundauthors[$i];
                  
                  if($last == -1){
                    $last = rand(0,$randMax);
                  }
                  else{
                    $forLast = rand(0,$randMax);
                    while($last == $forLast){
                      $forLast = rand(0,$randMax);
                    }
                    $last = $forLast;
                  }
                ?>
                <a href="./listen/?s=<?php echo $soundIdTemp;?>" target = "_blank">
                  <section class = "song-container background<?php echo $last;?>">

                  <header class = "song-header"><?php echo $soundName;?></header>
                  <footer class="song-author">By <?php echo $soundauthor;?></footer>
                  </section>
                </a><?php
              } }?>
            </section>            
            <section class="videos-container">
            <?php 
              if($ifVideos == 0){
                ?><div class="no-sounds">
                  <header class="no-soundsHeader">Sorry, there is no videos uploaded</header>
                  <footer class="no-soundsFooter">Try later</footer>
                </div><?php
              }
              else{
                $last = -1;
                $randMax = 4;
                echo count($videoId);
                for($i = 0 ; $i < count($videoId); $i++){
                  $videoIdTemp = $videoId[$i];
                  $videoName = $videotitle[$i];
                  $videoLocalAuthor = $videoauthor[$i];
                  $videoLocalIcon = $videoIcon[$i];
                  if($videoLocalIcon == ""){
                    if($last == -1){
                      $last = rand(0,$randMax);
                    }
                    else{
                      $forLast = rand(0,$randMax);
                      while($last == $forLast){
                        $forLast = rand(0,$randMax);
                      }
                      $last = $forLast;
                    }
                  }
                  else{
                    $videoLocalIcon = substr($videoLocalIcon,4);
                  }
                ?>
                <a href="./video/?s=<?php echo $videoIdTemp;?>" target = "_blank">
                  <?php
                  if($videoLocalIcon == ""){
                    ?><section class = "video-container background<?php echo $last;?>"><?php
                  }
                  else{
                    ?><section class = "video-container" style = "background: url('<?php echo $videoLocalIcon;?>'); background-size: cover;"><?php
                  } ?>
                  

                  <header class = "song-header"><?php echo $videoName;?></header>
                  <footer class="song-author">By <?php echo $videoLocalAuthor;?></footer>
                  </section>
                </a><?php
              } }?>
            </section>
      </section>
    </section>