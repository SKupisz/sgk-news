document.querySelector(".box").style.display = "none";
document.querySelector(".writing").style.display = "none";
document.querySelector(".blacklist").style.display = "none";
document.querySelector(".userList").style.display = "none";
document.querySelector(".blockingForm").style.display = "none";
document.querySelector(".goCheckTheBox").addEventListener("click",function(){
  if(document.querySelector(".box").style.display == "none"){
    document.querySelector(".box").style.display = "block";
    document.querySelector(".writing").style.display = "none";
    document.querySelector(".blacklist").style.display = "none";
  }
  else{
    document.querySelector(".box").style.display = "none";
  }
  
});
document.querySelector(".goWriteTheEmail").addEventListener("click",function(){
  if(document.querySelector(".writing").style.display == "none"){
    document.querySelector(".writing").style.display = "block";
    document.querySelector(".box").style.display = "none";
    document.querySelector(".blacklist").style.display = "none";
  }
  else{
    document.querySelector(".writing").style.display = "none";
  }
  
});
document.querySelector(".goBlackListing").addEventListener("click",function(){
  if(document.querySelector(".blacklist").style.display == "none"){
    document.querySelector(".blacklist").style.display = "block";
    document.querySelector(".box").style.display = "none";
    document.querySelector(".writing").style.display = "none";
  }
  else{
    document.querySelector(".blacklist").style.display = "none";
  }
  
});

document.querySelector(".list").addEventListener("click",function(){
  if(document.querySelector(".userList").style.display == "none"){
    document.querySelector(".userList").style.display = "block";
    document.querySelector(".blockingForm").style.display = "none";
  }
  else{
    document.querySelector(".userList").style.display = "none";
  }
});
document.querySelector(".block").addEventListener("click",function(){
  if(document.querySelector(".blockingForm").style.display == "none"){
    document.querySelector(".blockingForm").style.display = "block";
    document.querySelector(".userList").style.display = "none";
  }
  else{
    document.querySelector(".blockingForm").style.display = "none";
  }
});


function failedComment(Title,bodyContent){
  Push.create(Title,{
    body: bodyContent,
    icon: "./main/logo.png"
  });
};
function mailingInfo(Title,Body){
  if(Push.Permission.has() == false){
    Push.Permission.request(() => {failedComment(Title,Body)},() => {});
  }
  else{
    failedComment(Title,Body);
  }
};

function unblockTheUser(userName){
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      let response = this.response;
      if(response == "User unblocked"){
        mailingInfo("Blocking","User unblocked");
        let row = document.querySelector("#u_"+userName);
        let userList = document.querySelector(".userList");
        userList.removeChild(row);
        if(userList.childElementCount == 1){
          userList.removeChild(document.querySelector(".blacklist-desc"));
          userList.innerHTML = '<section class = "u9cblnone">There is no user on your black list</section>';
        }
      }
      else{
        mailingInfo("Blocking error",response);
      }
    }
  }
  xmlhttp.open("GET","./inbox/deleteFromBL.php?u="+userName,true);
  xmlhttp.send();
}

function clearTheBlocked(){
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      let response = this.response;
      if(response == "cleared"){
        mailingInfo("Blocking","All users unblocked");
        document.querySelector(".userList").innerHTML = '<section class = "u9cblnone">There is no user on your black list</section>';
      }
      else{
        mailingInfo("Blocking error",response);
      }
    }
  }
  xmlhttp.open("GET","./inbox/clearBlackList.php");
  xmlhttp.send();
}