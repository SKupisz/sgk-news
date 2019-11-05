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