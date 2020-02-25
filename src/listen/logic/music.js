let isPlaying = 0;

function play(address){
    event.preventDefault();
    let music = document.querySelector("#"+address);
      if(music.paused){
        event.target.innerHTML = "||";
          music.play();
          isPlaying = 1;
          //afterPlaying(address);
      }
      else{
        event.target.innerHTML = "▶";
          music.pause();
          isPlaying = 0;
      }
}

function afterPlaying(){
  console.log("stop");
  document.querySelector(".play-button").innerHTML = "▶";
  
}

function reload(address){
    event.preventDefault();
    let music = document.querySelector("#"+address);
    let gateway = event.target.parentNode.querySelector(".play-button");
    gateway.innerHTML = "▶";
    music.load();
}

function failedComment(Title,bodyContent){
  Push.create(Title,{
    body: bodyContent,
    icon: "./main/logo.png"
  });
}

function sendSoundLike(soundId){
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      let anwser = this.response;
      console.log(anwser);
      if(anwser == "Not signed"){
        if(Push.Permission.has() == false){
          Push.Permission.request(() => {failedComment("Liking error","You must be signed in for be able to like this picture")},() => {});
        }
        else{
          failedComment("Liking error","You must be signed in for be able to like this picture");
        }
      }
      else if(anwser == "Connection failure"){
        if(Push.Permission.has() == false){
          Push.Permission.request(() => {failedComment("Connection error","Sorry,something went wrong. Try later")},() => {});
        }
        else{
          failedComment("Connection error","Sorry,something went wrong. Try later");
        }
      }
      else if(anwser == "done upper"){
        let forIdentify = parseInt(document.querySelector("#likes-quantity").innerHTML);
        if(forIdentify != NaN){
          forIdentify++;
          document.querySelector("#likes-quantity").innerHTML = forIdentify;

        }
      }
      else if(anwser == "done lower"){
        let forIdentify = parseInt(document.querySelector("#likes-quantity").innerHTML);
        if(forIdentify != NaN){
          forIdentify--;
          document.querySelector("#likes-quantity").innerHTML = forIdentify;

        }
      }
    }
  };
  xmlhttp.open("GET","../src/listen/likeTheMusic.php?id="+soundId,true);
  xmlhttp.send();
}