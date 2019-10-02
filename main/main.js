let linksContDisp = document.querySelector(".links-container");
document.querySelector(".navOpening").addEventListener("click",function(matching){
  if(linksContDisp.style.display == "none" || linksContDisp.style.display == "" || matching.matches){
    linksContDisp.style.display = "block";
  }
  else{
    linksContDisp.style.display = "none";
  }
});

function forShowingNavAfterRWD(m){
  if(m.matches){
    linksContDisp.style.display = "block";
  }
  else{
    linksContDisp.style.display = "none";
  }
};

let match = window.matchMedia("(min-width: 967px)");
forShowingNavAfterRWD(match);
match.addListener(forShowingNavAfterRWD);