function failedComment(Title,bodyContent){
    Push.create(Title,{
      body: bodyContent,
      icon: "./main/logo.png"
    });
  }
  
function sendVideoLike(videoId){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        let anwser = this.response;
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
          let forIdentify = parseInt(document.querySelector(".likes-quantity").innerHTML);
          if(forIdentify != NaN){
            forIdentify++;
            document.querySelector(".likes-quantity").innerHTML = forIdentify;
  
          }
        }
        else if(anwser == "done lower"){
          let forIdentify = parseInt(document.querySelector(".likes-quantity").innerHTML);
          if(forIdentify != NaN){
            forIdentify--;
            document.querySelector(".likes-quantity").innerHTML = forIdentify;
  
          }
        }
        else if(anwser == "done lower lower"){
            let forIdentify = parseInt(document.querySelector(".likes-quantity").innerHTML);
            if(forIdentify != NaN){
              forIdentify++;
              document.querySelector(".likes-quantity").innerHTML = forIdentify;
    
            }
            forIdentify = parseInt(document.querySelector(".dislikes-quantity").innerHTML);
            if(forIdentify != NaN){
              forIdentify--;
              document.querySelector(".dislikes-quantity").innerHTML = forIdentify;
    
            }
          }
          else if(anwser == "done lower upper"){
            let forIdentify = parseInt(document.querySelector(".likes-quantity").innerHTML);
            if(forIdentify != NaN){
              forIdentify--;
              document.querySelector(".likes-quantity").innerHTML = forIdentify;
    
            }
        }
      }
    };
    xmlhttp.open("GET","../src/video/client/likeTheVideo.php?id="+videoId,true);
    xmlhttp.send();
}

function sendVideoDislike(videoId){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        let anwser = this.response;
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
          let forIdentify = parseInt(document.querySelector(".likes-quantity").innerHTML);
          if(forIdentify != NaN){
            forIdentify++;
            document.querySelector(".dislikes-quantity").innerHTML = forIdentify;
  
          }
        }
        else if(anwser == "done lower"){
          let forIdentify = parseInt(document.querySelector(".likes-quantity").innerHTML);
          if(forIdentify != NaN){
            forIdentify--;
            document.querySelector(".dislikes-quantity").innerHTML = forIdentify;
  
          }
        }
        else if(anwser == "done lower upper"){
            let forIdentify = parseInt(document.querySelector(".likes-quantity").innerHTML);
            if(forIdentify != NaN){
              forIdentify--;
              document.querySelector(".likes-quantity").innerHTML = forIdentify;
    
            }
            forIdentify = parseInt(document.querySelector(".dislikes-quantity").innerHTML);
            if(forIdentify != NaN){
              forIdentify++;
              document.querySelector(".dislikes-quantity").innerHTML = forIdentify;
    
            }
          }
          else if(anwser == "done lower lower"){
            let forIdentify = parseInt(document.querySelector(".dislikes-quantity").innerHTML);
            if(forIdentify != NaN){
              forIdentify--;
              document.querySelector(".dislikes-quantity").innerHTML = forIdentify;
    
            }
        }
      }
    };
    xmlhttp.open("GET","../src/video/client/dislikeTheVideo.php?id="+videoId,true);
    xmlhttp.send();
}