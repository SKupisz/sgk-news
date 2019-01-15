let control = 0;
let without = 1;
document.getElementById("upanelopen").addEventListener("click",function(){
  if(control == 0)
  {
    $("#upanel").show(500);
    control = 1;
    without = 1;
  }
  else {
    $("#upanel").hide(500);
    control = 0;
    without = 0;
  }

});
checkIfControl();
function checkIfControl(){
  if(window.innerWidth > 1024){
    without = 1;
    
  }
}
