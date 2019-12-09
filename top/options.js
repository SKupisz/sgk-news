function failedComment(Title,bodyContent){
  Push.create(Title,{
    body: bodyContent,
    icon: "./main/logo.png"
  });
}
function sendImageLike(imageId){
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
        let forIdentify = parseInt(document.querySelector("#quantity"+imageId).innerHTML);
        if(forIdentify != NaN){
          forIdentify++;
          document.querySelector("#quantity"+imageId).innerHTML = forIdentify;

        }
      }
      else if(anwser == "done lower"){
        let forIdentify = parseInt(document.querySelector("#quantity"+imageId).innerHTML);
        if(forIdentify != NaN){
          forIdentify--;
          document.querySelector("#quantity"+imageId).innerHTML = forIdentify;

        }
      }
    }
  };
  xmlhttp.open("GET","./top/images/likeImage.php?id="+imageId,true);
  xmlhttp.send();
}
function sentArticleLike(artId){
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200 ){
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
        let forIdentify = parseInt(document.querySelector("#likes-container"+artId).innerHTML);
        if(forIdentify != NaN){
          forIdentify++;
          document.querySelector("#likes-container"+artId).innerHTML = forIdentify;

        }
      }
      else if(anwser == "done lower"){
        let forIdentify = parseInt(document.querySelector("#likes-container"+artId).innerHTML);
        if(forIdentify != NaN){
          forIdentify--;
          document.querySelector("#likes-container"+artId).innerHTML = forIdentify;

        }
      }
    }
  };
  xmlhttp.open("GET","./top/likes/like.php?id="+artId,true);
  xmlhttp.send();
}