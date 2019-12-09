  <ul id = "upanel">
  <li class="image_li"><a href="index.php"><img id="logo" src="logo.png"></a></li>  
  <li class = "navOpening">
    <span></span>
    <span></span>
    <span class = "theLastOne"></span>
  </li>
  <section class = "links-container">
  <li class="left_li"><a href = "top.php" class="navlink">
      Articles
  </a></li>
  
  <li class="left_li"><a href = "about.php" class="navlink">
      About us
  </a></li>
  <li class="left_li"><a href = "bulletin.php" class="navlink">
      Public bulletin
  </a></li>
    
      
  <?php if(isset($_SESSION['zalogowany']))
  {
    ?>
    <li class="left_li"><a href = "articles.php"class="navlink">
        Your articles
  </a></li>
    <li class="left_li"><a href = "inbox.php" class="navlink">
        Inbox
  </a></li>
  <li class="right_li"><a href = "logout.php" class="navlink">
        Logout
    </a></li>
    <li class="right_li"><a href = "profile.php" class="navlink">
        Profile
    </a></li>
    <li class="right_li"><a href = "settings.php" class="navlink">
        Settings
    </a></li><?php
  }
  else{?>
    <li class="right_li"><a href = "login.php" class="navlink">
        Sign in
    </a></li>
    <li class="right_li"><a href = "register.php" class="navlink">
        Sign up
    </a></li>
<?php }?>
  </section>
</ul>
    
    
</section>
