<section class = "action-block blacklist">
      <section class = "choosing-mode">
        <button class = "choosing-buttons list">Your list</button>
        <button class = "choosing-buttons block">Block a user</button>
      </section>
      <section class = "blacklistMood-container userList">
      <?php
      if($ifBlackRows == 0)
      {
        ?><section class = "u9cblnone">There is no user on your black list</section><?php
      }
      else {
        ?><nav class = "blacklist-desc">
        <div class = "blacklist-descItem from">
          Username
        </div>
        <div class = "blacklist-descItem topic">
          Blocked since
        </div>
        <div class = "blacklist-descItem signAll">
          <button class = "unBlockingAllBtn" onClick = "clearTheBlocked()">Unblock all</button>
        </div>
      </nav><?php
        if($blockedLength <= 30)
        {
          for($i = 0 ; $i < $blockedLength; $i++)
          {
            $name = $blockedNames[$i];
            $date = $blockedDates[$i];
            ?>
                    <div class = "email-row" id = "u_<?php echo $name;?>">
          <div class = "email-rowItem from">
            <?php echo $name; ?>
          </div>
          <div class = "email-rowItem topic">
            <?php echo $date; ?>
          </div>
          <div class = "email-rowItem signAll">
            <button class = "unBlockingBtn" onClick = "unblockTheUser('<?php echo $name;?>')">Unblock</button>
          </div>
        </div><?php
          }
        }
      }?>
      </section>
      <section class = "blacklistMood-container blockingForm">
      <header class = "blocking-header">
        Blocking a user
      </header>
      <form method = "post" action = "./inbox/onBlackList.php">
        <div class = "blocking-Item receiver">
          <div class = "blockingItem-desc">Username:  </div>
          <input type = "text" name = "usernameToBlock" placeholder = "Username..." class = "blocking-input"/>
        </div>
        <button class = "confirm-button" type = "submit">Block</button>
      </form>
      </section>
    </section>