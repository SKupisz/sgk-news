<!--
<section id = "u1">
  <a href = "index.php" id = "logo" class="left_li">
    <img src="main/logo.png" alt="logo" id = "u2i"/>
  </a>
  <button id = "upanelopen">
    Menu
  </button>
doesnt seem to be needed 
    
    
  <label id = "upanelofical">
  <a href = "top.php" id = "u3" class="left_li" class="navlink">
    <nav class = "menDescLower">Artykuły</nav>
  </a>
  <a href = "articles.php" id = "u4" class="left_li" class="navlink">
    <nav class = "menDescLower">??Your articles</nav>
  </a>
  <a href = "inbox.php" id = "u5" class="left_li" class="navlink">
    <nav class = "menDesc">??Inbox</nav>
  </a>
  <a href = "about.php" id = "u6" class="left_li" class="navlink">
    <nav class = "menDesc">O nas</nav>
  </a>
      
      
  <?php if(isset($_SESSION['zalogowany']))
  {
    ?>
    <a href = "settings.php" id = "u7" class="right_li" class="navlink">
      <nav class = "menDesc">Ustawienia</nav>
    </a>
    <a href = "profile.php" id = "u8" class="right_li" class="navlink">
      <nav class = "menDesc">Profil</nav>
    </a>
    <a href = "logout.php" id = "u9d" class="right_li" class="navlink">
      <nav class = "menDesc">Wyloguj się</nav>
    </a><?php
  }     
  else{?>
  <a href = "login.php" id = "u7" class="right_li" class="navlink">
    <nav class = "menDesc">Zaloguj się</nav>
  </a>
  <a href = "register.php" id = "u8" class="right_li" class="navlink">
    <nav class = "menDesc">Zarejestruj się</nav>
  </a>
<?php }?>
</label>

-->
    
    
    
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
        Setting
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
