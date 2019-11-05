var atrAlpha = 0;
let tagsList = [];
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

beingWrittenOpen();

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
function tagOperand(tagName){
  if(tagsList.includes(tagName))
  {
    tagsList.splice(tagsList.indexOf(tagName),1);
    document.getElementById(tagName).classList.remove("tagSigned");
  }
  else {
    tagsList.push(tagName);
    document.getElementById(tagName).classList.add("tagSigned");
  }
  let finalTags = "";
  for(var i = 0 ; i < tagsList.length; i++)
  {
    finalTags+=tagsList[i];
    if(i != tagsList.length-1)
    {
      finalTags+=" ";
    }
  }
  document.querySelector(".u11moreInfo").value = finalTags;
}
document.getElementById("politicTag").addEventListener("click",function(){
tagOperand("politicTag");
});
document.getElementById("entertaimentTag").addEventListener("click",function(){
tagOperand("entertaimentTag");
});
document.getElementById("literatureTag").addEventListener("click",function(){
tagOperand("literatureTag");
});
document.getElementById("scienceTag").addEventListener("click",function(){
tagOperand("scienceTag");
});
document.getElementById("otherTag").addEventListener("click",function(){
tagOperand("otherTag");
});
document.querySelector("#bar2").addEventListener("click",function(){
  this.classList.add("now");
  document.querySelector("#bar1").classList.remove("now");
  document.querySelector(".sendingArticle").style.display = "none";
  document.querySelector(".imageUpload").style.display = "block";
});
document.querySelector("#bar1").addEventListener("click",function(){
  this.classList.add("now");
  document.querySelector("#bar2").classList.remove("now");
  document.querySelector(".sendingArticle").style.display = "block";
  document.querySelector(".imageUpload").style.display = "none";
});
function imageLoad(){
  document.querySelector("#bar2").classList.add("now");
  document.querySelector("#bar1").classList.remove("now");
  document.querySelector(".sendingArticle").style.display = "none";
  document.querySelector(".imageUpload").style.display = "block";
}

function failedComment(Title,bodyContent){
  Push.create(Title,{
    body: bodyContent,
    icon: "./main/logo.png"
  });
}
function openTheAlert(Title,Body){
  if(Push.Permission.has() == false){
    Push.Permission.request(() => {failedComment(Title,Body)},() => {});
  }
  else{
    failedComment(Title,Body);
  }
}
