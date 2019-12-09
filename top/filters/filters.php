<section id = "u10bar" onclick = "openFilters();">
  Filters
</section>
<nav id = "u10filtersbar">
  <div class = "u10sort" onclick = "openSort();" id = "u10ad">
    Sorting
  </div>
  <div class = "u10name" onclick = "openName();" id = "u10ad">
    Name
  </div>
  <div class = "u10tags" onclick = "openTags();" id = "u10ad">
    Tags
  </div>
  <div class = "u10words" onclick = "openWords();" id = "u10ad">
    Length
  </div>
</nav>
<section class = "u10sortAdvance">
  <a href = "top/filters/impression.php?b=1">
    <div class = "u10bi">
      <div class = "btnContent-container">
        From the biggest impression
      </div>
    </div>
  </a>
  <a href = "top/filters/impression.php?b=0">
    <div class = "u10li">
      <div class = "btnContent-container">
        From the lowest impression
      </div>
    </div>
</a>
</section>
<section class = "u10nameAdvance">
  <form method = "post" action = "top/filters/searchArticles.php">
    <div class = "formContent-wrapper">
      <input type = "text" name = "articleName" class = "u10an" placeholder="Article name"/>
      <input type = "submit" value = "Search" class = "u10as"/>
  </div>
  </form>
</section>
<section class = "u10tagsAdvance">
  <form method = "post" action = "top/filters/tags.php">
    <input type = "checkbox" id = "politicBtn" class = "tagsBtn" name = "politic"/>
    <div class = "labelContainer" id = "labelOne" onClick = "clickedCheckbox('#politicBtn')">
      <label class = "tagsLabel" class = "politic">Politic</label>
    </div>
    <input type = "checkbox" id = "literatureBtn" class = "tagsBtn" name = "literature"/>
    <div class = "labelContainer" id = "labelTwo" onClick = "clickedCheckbox('#literatureBtn')">
      <label class = "tagsLabel" class = "literature">Literature</label>
    </div>    
    <input type = "checkbox" id = "scienceBtn" class = "tagsBtn" name = "science"/>
    <div class = "labelContainer" id = "labelThree" onClick = "clickedCheckbox('#scienceBtn')">
      <label class = "tagsLabel" class = "science">Science</label>
    </div>
    <input type = "checkbox" id = "entertaimentBtn" class = "tagsBtn" name = "entertaiment"/>
    <div class = "labelContainer" id = "labelFour" onClick = "clickedCheckbox('#entertaimentBtn')">
      <label class = "tagsLabel" class = "entertaiment">Entertaiment</label>
    </div>
    <input type = "checkbox" id = "otherBtn" class = "tagsBtn" name = "other"/>
    <div class = "labelContainer" order = "last" id = "labelFive" onClick = "clickedCheckbox('#otherBtn')">
      <label class = "tagsLabel" class = "other">Other</label>
    </div>
    <input type = "submit" value = "Search" class = "u10tagsSubmit" class = "u10tagsSubmit"/>
  </form>
</section>
<section class = "u10wordsAdvance">
  <a href = "top/filters/words.php?b=0&t=50">
    <nav class = "u10min">To 50 words</nav></a>
  <a href = "top/filters/words.php?b=50&t=100"><nav class = "u10s">50-100 words</nav></a>
  <a href = "top/filters/words.php?b=100&t=200"><nav class = "u10t">100-200 words</nav></a>
  <a href = "top/filters/words.php?b=200&t=300"><nav class = "u10f">200-300 words</nav></a>
  <a href = "top/filters/words.php?b=300&t=0"><nav class = "u10max">Over 300 words</nav></a>
</section>
