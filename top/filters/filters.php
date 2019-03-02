<section id = "u10bar" onclick = "openFilters();">
  Filters
</section>
<nav id = "u10filtersbar">
  <div id = "u10sort" onclick = "openSort();" class = "u10ad">
    Sorting
  </div>
  <div id = "u10name" onclick = "openName();" class = "u10ad">
    Name
  </div>
  <div id = "u10tags" onclick = "openTags();" class = "u10ad">
    Tags
  </div>
  <div id = "u10words" onclick = "openWords();" class = "u10ad">
    Length
  </div>
</nav>
<section id = "u10sortAdvance">
  <a id = "u10bi" href = "top/filters/impression.php?b=1">
    <label>From the biggest impression</label>
  </a>
  <a id = "u10li" href = "top/filters/impression.php?b=0">
  <label>From the lowest impression</label>
</a>
</section>
<section id = "u10nameAdvance">
  <form method = "post" action = "top/filters/searchArticles.php">
    <input type = "text" name = "articleName" id = "u10an" placeholder="Article name"/>
    <input type = "submit" value = "Search" id = "u10as"/>
  </form>
</section>
<section id = "u10tagsAdvance">
  <form method = "post" action = "top/filters/tags.php">
    <input type = "checkbox" id = "politicBtn" class = "tagsBtn" name = "politic"/>
    <label class = "tagsLabel" id = "politic" for = "politicBtn">Politic</label>
    <input type = "checkbox" id = "literatureBtn" class = "tagsBtn" name = "literature"/>
    <label class = "tagsLabel" id = "literature" for = "literatureBtn">Literature</label>
    <input type = "checkbox" id = "scienceBtn" class = "tagsBtn" name = "science"/>
    <label class = "tagsLabel" id = "science" for = "scienceBtn">Science</label>
    <input type = "checkbox" id = "entertaimentBtn" class = "tagsBtn" name = "entertaiment"/>
    <label class = "tagsLabel" id = "entertaiment" for = "entertaimentBtn">Entertaiment</label>
    <input type = "checkbox" id = "otherBtn" class = "tagsBtn" name = "other"/>
    <label class = "tagsLabel" id = "other" for = "otherBtn">Other</label>
    <input type = "submit" value = "Search" class = "u10tagsSubmit" id = "u10tagsSubmit"/>
  </form>
</section>
<section id = "u10wordsAdvance">
  <a id = "u10min" href = "top/filters/words.php?b=0&t=50">
    <nav >To 50 words</nav></a>
  <a id = "u10s" href = "top/filters/words.php?b=50&t=100"><nav>50-100 words</nav></a>
  <a id = "u10t" href = "top/filters/words.php?b=100&t=200"><nav>100-200 words</nav></a>
  <a id = "u10f" href = "top/filters/words.php?b=200&t=300"><nav>200-300 words</nav></a>
  <a id = "u10max" href = "top/filters/words.php?b=300&t=0"><nav>Over 300 words</nav></a>
</section>
