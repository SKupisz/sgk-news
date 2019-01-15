<section id = "u1">
  <a href = "index.php" id = "u2">
    <img src="noweLogo2.png" alt="logo" id = "u2i"/>
  </a>
  <button id = "upanelopen">
    Menu
  </button>
  <label id = "upanelofical">
  <a href = "top.php" id = "u3">
    <nav class = "menDescLower">Top articles</nav>
  </a>
  <a href = "articles.php" id = "u4">
    <nav class = "menDescLower">Your articles</nav>
  </a>
  <a href = "inbox.php" id = "u5">
    <nav class = "menDesc">Inbox</nav>
  </a>
  <a href = "about.php" id = "u6">
    <nav class = "menDesc">About us</nav>
  </a>
  <?php if(isset($_SESSION['zalogowany']))
  {
    ?>
    <a href = "settings.php" id = "u7">
      <nav class = "menDesc">Settings</nav>
    </a>
    <a href = "profile.php" id = "u8">
      <nav class = "menDesc">Profile</nav>
    </a>
    <a href = "logout.php" id = "u9d">
      <nav class = "menDesc">Logout</nav>
    </a><?php
  }
  else{?>
  <a href = "login.php" id = "u7">
    <nav class = "menDesc">Sign in</nav>
  </a>
  <a href = "register.php" id = "u8">
    <nav class = "menDesc">Sign up</nav>
  </a>
<?php }?>
</label>
  <label id = "upanel">
  <a href = "top.php" id = "u3">
    Top articles
  </a>
  <a href = "articles.php" id = "u4">
    Your articles
  </a>
  <a href = "inbox.php" id = "u5">
    Inbox
  </a>
  <a href = "about.php" id = "u6">
    About us
  </a>
  <?php if(isset($_SESSION['zalogowany']))
  {
    ?>
    <a href = "settings.php" id = "u7">
      Settings
    </a>
    <a href = "profile.php" id = "u8">
      Profile
    </a>
    <a href = "logout.php" id = "u9d">
      Logout
    </a><?php
  }
  else{?>
    <a href = "login.php" id = "u7">
      Sign in
    </a>
    <a href = "register.php" id = "u8">
      Sign up
    </a>
<?php }?>
</label>
</section>
