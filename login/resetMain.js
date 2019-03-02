document.querySelector(".firstInput").oninput = function(){
  var alpha = document.querySelector(".firstInput").value;
  var betha = document.querySelector(".secondInput").value;
  var ending = "Your password must contain: ";
  if(alpha.length < 8)
  {
    ending+="at least 8 signs ";
  }
  if(alpha.toUpperCase() === alpha){
    ending+="a lowercase ";
  }
  if(alpha.toLowerCase() === alpha){
    ending+="an uppercase ";
  }
  if(ending != "Your password must contain: " && alpha.length > 0)
  {
    document.querySelector(".passwordFirstInfo").innerHTML = ending;
    document.querySelector(".firstInput").classList.add("inputIncorrect");
    document.querySelector(".firstInput").classList.remove("inputCorrect");
  }
  else if(alpha.length == 0)
  {
    document.querySelector(".passwordFirstInfo").innerHTML = "";
    document.querySelector(".firstInput").classList.remove("inputIncorrect");
    document.querySelector(".firstInput").classList.remove("inputCorrect");
  }
  else {
    document.querySelector(".passwordFirstInfo").innerHTML = "";
    document.querySelector(".firstInput").classList.remove("inputIncorrect");
    document.querySelector(".firstInput").classList.add("inputCorrect");
  }
};

document.querySelector(".secondInput").oninput = function(){
  var alpha = document.querySelector(".firstInput").value;
  var betha = document.querySelector(".secondInput").value;
  var ending = "";
  if(alpha !== betha)
  {
    ending+="The passwords are not the same";
  }
  if(ending != "" && betha.length > 0)
  {
    document.querySelector(".passwordSecondInfo").innerHTML = ending;
    document.querySelector(".secondInput").classList.add("inputIncorrect");
    document.querySelector(".secondInput").classList.remove("inputCorrect");
  }
  else if(betha.length == 0)
  {
    document.querySelector(".passwordSecondInfo").innerHTML = "";
    document.querySelector(".secondInput").classList.remove("inputIncorrect");
    document.querySelector(".secondInput").classList.remove("inputCorrect");
  }
  else {
    document.querySelector(".passwordSecondInfo").innerHTML = "";
    document.querySelector(".secondInput").classList.remove("inputIncorrect");
    document.querySelector(".secondInput").classList.add("inputCorrect");
  }
};
