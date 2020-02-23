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
            for($i = 0 ;$i < count($soundId); $i++){
              $soundIdTemp = $soundId[$i];
              $soundName = $soundtitle[$i];
              $soundaddr = $soundaddress[$i];
              $soundaddr = substr($soundaddr,4);
              ?>    
              <section class = "song-container background<?php echo rand(0,3);?>">
                <audio class = "local-song" id = "play<?php echo $i+1;?>">
                  <source src = "<?php echo $soundaddr;?>" type = "audio/mp3"/>
                </audio>
              <header class = "song-header"><?php echo $soundName;?></header>
              <button class = "music-buttons play-button" id = "playId<?php echo $soundIdTemp;?>" onclick = "play('play<?php echo $i+1;?>')">
              ▶
            </button>
              <button class = "music-buttons reload-button" onclick = "reload('play<?php echo $i+1;?>')">⟳</button>
              </section><?php
            }
          }
        ?>
      </section>
    </section>