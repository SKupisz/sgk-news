var filtersalpha = 0;
var sortalpha = 0;
var namealpha = 0;
var tagsalpha = 0;
var wordsalpha = 0;
function openFilters(){
  if(filtersalpha == 0)
  {
    document.querySelector("#u10filtersbar").style.display = "block";
    filtersalpha = 1;
  }
  else {
    document.querySelector("#u10filtersbar").style.display = "none";
    document.querySelector("#u10sortAdvance").style.display = "none";
    document.querySelector("#u10nameAdvance").style.display = "none";
    document.querySelector("#u10tagsAdvance").style.display = "none";
    document.querySelector("#u10wordsAdvance").style.display = "none";
    filtersalpha = 0;
    sortalpha = 0;
    namealpha = 0;
    tagsalpha = 0;
    wordsalpha = 0;
  }

}
function openSort(){
  var wdt = window.innerWidth;
  if(wdt <= 800)
  {
    if(sortalpha == 0)
    {
      document.querySelector("#u10sortAdvance").style.display = "block";
      document.querySelector("#u10nameAdvance").style.display = "none";
      document.querySelector("#u10wordsAdvance").style.display = "none";
      document.querySelector("#u10tagsAdvance").style.display = "none";
      sortalpha = 1;
      tagsalpha = 0;
      wordsalpha = 0;
      namealpha = 0;
    }
    else {
      document.querySelector("#u10sortAdvance").style.display = "none";
      sortalpha = 0;
    }
  }
  else {
    if(sortalpha == 0)
    {
      document.querySelector("#u10sortAdvance").style.display = "block";
      sortalpha = 1;
    }
    else {
      document.querySelector("#u10sortAdvance").style.display = "none";
      sortalpha = 0;
    }
  }


}
function openName(){
  var wdt = window.innerWidth;
  if(wdt <= 800)
  {
    if(namealpha == 0)
    {
      document.querySelector("#u10nameAdvance").style.display = "block";
      document.querySelector("#u10sortAdvance").style.display = "none";
      document.querySelector("#u10wordsAdvance").style.display = "none";
      document.querySelector("#u10tagsAdvance").style.display = "none";
      namealpha = 1;
      tagsalpha = 0;
      wordsalpha = 0;
      sortalpha = 0;
    }
    else {
      document.querySelector("#u10nameAdvance").style.display = "none";
      namealpha = 0;
    }
  }
  else {
    if(namealpha == 0)
    {
      document.querySelector("#u10nameAdvance").style.display = "block";
      document.querySelector("#u10tagsAdvance").style.display = "none";
      tagsalpha = 0;
      namealpha = 1;
    }
    else {
      document.querySelector("#u10nameAdvance").style.display = "none";
      namealpha = 0;
    }
  }

}
function openTags(){
  var wdt = window.innerWidth;
  if(wdt <= 800)
  {
    if(tagsalpha == 0)
    {
      document.querySelector("#u10nameAdvance").style.display = "none";
      document.querySelector("#u10sortAdvance").style.display = "none";
      document.querySelector("#u10wordsAdvance").style.display = "none";
      document.querySelector("#u10tagsAdvance").style.display = "block";
      namealpha = 0;
      tagsalpha = 1;
      wordsalpha = 0;
      sortalpha = 0;
    }
    else {
      document.querySelector("#u10tagsAdvance").style.display = "none";
      tagsalpha = 0;
    }
  }
  else {
    if(tagsalpha == 0)
    {
      document.querySelector("#u10tagsAdvance").style.display = "block";
      document.querySelector("#u10nameAdvance").style.display = "none";
      document.querySelector("#u10wordsAdvance").style.display = "none";
      wordsalpha = 0;
      tagsalpha = 1;
      namealpha = 0;
    }
    else {
      document.querySelector("#u10tagsAdvance").style.display = "none";
      tagsalpha = 0;
    }
  }
}
function openWords(){
  var wdt = window.innerWidth;
  if(wdt <= 800)
  {
    if(wordsalpha == 0)
    {
      document.querySelector("#u10wordsAdvance").style.display = "block";
      document.querySelector("#u10sortAdvance").style.display = "none";
      document.querySelector("#u10nameAdvance").style.display = "none";
      document.querySelector("#u10tagsAdvance").style.display = "none";
      wordsalpha = 1;
      namealpha = 0;
      sortalpha = 0;
      tagsalpha = 0;
    }
    else {
      document.querySelector("#u10wordsAdvance").style.display = "none";
      wordsalpha = 0;
    }
  }
  else {
    if(wordsalpha == 0)
    {
      document.querySelector("#u10tagsAdvance").style.display = "none";
      document.querySelector("#u10wordsAdvance").style.display = "block";
      tagsalpha = 0;
      wordsalpha = 1;
    }
    else {
      document.querySelector("#u10wordsAdvance").style.display = "none";
      wordsalpha = 0;
    }
  }

}
function paralax_article(id)
{
  var background = document.querySelector(".u11list");
  var all = document.querySelector(".u11");
  var article = document.querySelector(".u11articleshowing");
  background.style.display = "none";
  all.style.height = "90%";
  all.style.top = "10%";
  article.style.height = "100%";
  article.style.top = "0px";
  article.style.display = "block";
  article.classList.add("going-up");
}
document.querySelector("#articles").addEventListener("click",function(){
  document.querySelector(".u11").style.display = "block";
  document.querySelector(".u12").style.display = "none";
  document.querySelector("#u10bar").style.display = "block";
  if(filtersalpha == 1)
  {
    document.querySelector("#u10filtersbar").style.display = "block";
    if(sortalpha == 1)
    {
      document.querySelector("#u10sortAdvance").style.display = "block";
    }
    if(namealpha == 1)
    {
      document.querySelector("#u10nameAdvance").style.display = "block";
    }
    if(tagsalpha == 1)
    {
      document.querySelector("#u10tagsAdvance").style.display = "block";
    }
    if(wordsalpha == 1)
    {
      document.querySelector("#u10wordsAdvance").style.display = "block";
    }
  }
});
document.querySelector("#images").addEventListener("click",function(){
  document.querySelector(".u11").style.display = "none";
  document.querySelector(".u12").style.display = "block";
  document.querySelector("#u10bar").style.display = "none";
  document.querySelector("#u10filtersbar").style.display = "none";
  document.querySelector("#u10sortAdvance").style.display = "none";
  document.querySelector("#u10nameAdvance").style.display = "none";
  document.querySelector("#u10tagsAdvance").style.display = "none";
  document.querySelector("#u10wordsAdvance").style.display = "none";
});
document.querySelector("#errorInformationClose").addEventListener("click",function(){
  document.body.querySelector(".errorInformation").remove();
});
