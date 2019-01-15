var atrAlpha = 0;
function beingWrittenOpen(){
  document.getElementById("u11ssection").style.display = "none";
  document.getElementById("u11csection").style.display = "none";
  document.getElementById("u11wsection").style.display = "none";
  document.getElementById("u11asection").style.display = "block";
}
function writingOpen(){
  document.getElementById("u11ssection").style.display = "none";
  document.getElementById("u11csection").style.display = "none";
  document.getElementById("u11asection").style.display = "none";
  document.getElementById("u11wsection").style.display = "block";
}
function sentOpen(){
  document.getElementById("u11ssection").style.display = "block";
  document.getElementById("u11csection").style.display = "none";
  document.getElementById("u11asection").style.display = "none";
  document.getElementById("u11wsection").style.display = "none";
}
function preloader(){
  setTimeout(function() {

        var body    =   document.getElementsByTagName("BODY")[0];
        var loader  =   document.getElementById("preloader");
        body.className   -=   "onLoadCut";
        loader.style.display = "none";
        beingWrittenOpen();

},3000);
}
function goWriting(id){
  window.location.assign("articles.php?sid="+id);
}
function seeStatistic(title,words,views,id){
  var background = document.querySelector(".more-other-wrapper");
  var content = document.querySelector("#u12more");
  var header = document.querySelector(".u12more-header");
  var words_counter = document.querySelector("#words");
  var views_counter = document.querySelector("#views");
  var name = document.querySelector("#place");
  header.innerHTML = title;
  words_counter.innerHTML = words+" words";
  views_counter.innerHTML = views+" views";
  name.innerHTML = "That is your "+id+" article";
  content.style.display = "block";
  content.classList.add("get-in");
  clearInterval(1000);
  background.style.display = "none";
}
function closeStatistic(){
  var background = document.querySelector(".more-other-wrapper");
  var content = document.querySelector("#u12more");
  var header = document.querySelector(".u12more-header");
  var words_counter = document.querySelector("#words");
  var views_counter = document.querySelector("#views");
  var name = document.querySelector("#place");
  header.innerHTML = "";
  words_counter.innerHTML = "";
  views_counter.innerHTML = "";
  name.innerHTML = "";
  content.classList.add("get-out");
  clearInterval(1000);
  content.style.display = "none";
  background.style.display = "block";
}
function atrOpen(){
  if(atrAlpha == 0)
  {
    document.querySelector("#u11atrca").style.display = "block";
    document.querySelector("#u11atrcr").style.display = "block";
    atrAlpha = 1;
  }
  else {
    document.querySelector("#u11atrca").style.display = "none";
    document.querySelector("#u11atrcr").style.display = "none";
    atrAlpha = 0;
  }

}
