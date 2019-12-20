document.querySelector(".box").style.display = "none";
document.querySelector(".writing").style.display = "none";
document.querySelector(".blacklist").style.display = "none";
document.querySelector(".userList").style.display = "none";
document.querySelector(".blockingForm").style.display = "none";
document.querySelector(".unreaded").disabled = true;
document.querySelector(".delete").disabled = true;
document.querySelector(".blocker").disabled = true;

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


localStorage.setItem("toEdit","");
document.querySelector("#main-checkbox").addEventListener("click",function(){
  if(document.querySelector("#main-checkbox").checked){
    let data = document.getElementsByClassName("subCheckbox");
    let finalStorage = "";
    for(let i = 0 ; i < data.length; i++){
      finalStorage+=data[i].id;
      finalStorage+=";";
    }
    localStorage.toEdit = finalStorage;
    for(let i = 0 ; i < data.length; i++){
      data[i].checked = true;
    }
  }
  else{
    let data = document.getElementsByClassName("subCheckbox");
    localStorage.toEdit = "";
    for(let i = 0 ; i < data.length ;i++){
      data[i].checked = false;
    }
    

  }

});

function goEditThisMessage(name){
  let id = document.querySelector("#"+name).id;
  let forSearch = localStorage.toEdit.split(";");
  let newStorage = "",flag = 0;
  for(let i = 0 ; i < forSearch.length; i++){
    if(forSearch[i] != id){
      newStorage+=forSearch[i];
        newStorage+=";";
        if(i == forSearch.length-1 && flag == 0){
        newStorage+=id;
      }
    }
    else{
      flag = 1;
    } 
  }
  if(newStorage[0] == ";") {newStorage = newStorage.substring(1);}
  if(newStorage[newStorage.length - 1] == ";"){newStorage = newStorage.substring(0,newStorage.length - 1);}
  localStorage.toEdit = newStorage;
  if(localStorage.toEdit.length > 0){
    document.querySelector(".unreaded").disabled = false;
    document.querySelector(".delete").disabled = false;
    document.querySelector(".blocker").disabled = false;
  }
  else{
    document.querySelector(".unreaded").disabled = true;
    document.querySelector(".delete").disabled = true;
    document.querySelector(".blocker").disabled = true;
  }
};