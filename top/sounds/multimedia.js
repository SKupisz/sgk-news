document.querySelector(".sound-item").addEventListener("click",function(){
    this.classList.add("item-signed");
    document.querySelector(".video-item").classList.remove("item-signed");
    document.querySelector(".sounds-container").style.display = "block";
    document.querySelector(".videos-container").style.display = "none";
});
document.querySelector(".video-item").addEventListener("click",function(){
    this.classList.add("item-signed");
    document.querySelector(".sound-item").classList.remove("item-signed");
    document.querySelector(".videos-container").style.display = "block";
    document.querySelector(".sounds-container").style.display = "none";
});