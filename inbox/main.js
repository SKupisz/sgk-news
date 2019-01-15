document.getElementById("u9mw").addEventListener("click",function(){
  document.getElementById("u9t").innerHTML = "Writing a message";
  $("#u9cr").hide(500);
//  $("#u9ct").hide(500);
  $("#u9cbl").hide(500);
  $("#u9cw").show(500);
});
document.getElementById("u9mr").addEventListener("click",function(){
  document.getElementById("u9t").innerHTML = "Your mailbox";
  $("#u9cr").show(500);
  //$("#u9ct").hide(500);
  $("#u9cbl").hide(500);
  $("#u9cw").hide(500);
});
document.getElementById("u9mbl").addEventListener("click",function(){
  document.getElementById("u9t").innerHTML = "Black List";
  $("#u9cr").hide(500);
  //$("#u9ct").hide(500);
  $("#u9cbl").show(500);
  $("#u9cw").hide(500);
});
document.getElementById("u9cbl_r").addEventListener("click",function(){
  $("#u9cbl_wc").hide(1);
  $("#u9cbl_rc").show(200);
});
document.getElementById("u9cbl_w").addEventListener("click",function(){
  $("#u9cbl_rc").hide(1);
  $("#u9cbl_wc").show(200);
});
function runPostForm(){
  $("#u9cr").hide(500);
  $("#u9cbl").hide(500);
  $("#u9cw").show(500);
}
function runPostBox(){
  $("#u9cr").show(500);
  $("#u9cbl").hide(500);
  $("#u9cw").hide(500);
}

let alfa = [];
function addToList(id){
  var ind = -1;
  for(var i = 0 ; i < alfa.length; i++)
  {
    if(alfa[i] == id)
    {
      ind = i;
      break;
    }
  }
  if(ind == -1)
  {
    alfa.push(id);
  }
  else {

    alfa.splice(ind,1);
  }
}
document.getElementById("u9crmt1").addEventListener("click",function(){
  var adres = "inbox/editRecive.php?nd="+alfa;
  window.open(adres);
});
function goToReader(id){
  var adres = "inbox/openMessage.php?nmb="+id;
  var win = window.open(adres, '_blank');
  win.focus();
}
let post_number = 1;
function left(){
  if(post_number > 0)
  {
    let pClass = "."+post_number;
    $(pClass).css("display","none");
    post_number-=1;
    pClass = "."+post_number;
    $(pClass).css("display","block");

  }

}
function right(){

    if(document.getElementsByClassName(post_number+1))
    {
      let pClass = "."+post_number;
      $(pClass).css("display","none");
      post_number+=1;
      pClass = "."+post_number;
      $(pClass).css("display","block");
    }


}
