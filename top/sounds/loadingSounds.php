<section class = "u13">
      <section class = "u13wrapper">
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
            }
          }
          /*     $soundaddr = $soundaddress[$i];
              $soundaddr = substr($soundaddr,4);           
                */
        ?>
      </section>
    </section>