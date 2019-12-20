function failedComment(Title,bodyContent){
    Push.create(Title,{
      body: bodyContent,
      icon: "./main/logo.png"
    });
  }
document.querySelector(".delete").addEventListener("click",function(){
    if(localStorage.toEdit.length > 0){
        console.log(localStorage.toEdit);
        let forSearch = localStorage.toEdit.split(";");
        console.log(forSearch.length);
        for(let i = 0 ; i < forSearch.length; i++){
            console.log(forSearch[i]);
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.status == 200 && this.readyState == 4){
                    let resp = this.response;
                    if(resp == "cleared"){
                        document.getElementById(forSearch[i]).parentElement.parentElement.parentElement.remove();
                    }
                    else{
                        if(resp == "wrong id"){
                            failedComment("Deleting message","Wrong id error. Try again");
                        }
                        else if(resp == "Message does not exist"){
                            failedComment("Deleting message","Wrong id error. Try again");
                        }
                        else if(resp == "Wrong connection"){
                            failedComment("Deleting message","Lost connection. Try later");   
                        }
                    }
                }
            }
            let forSending = forSearch[i];
            forSending = forSending.substring(7);
            xmlhttp.open("GET","./inbox/deleteMessage.php?id="+forSending);
            xmlhttp.send();
        }
        failedComment("Deleting message","Messages had just been deleted");
    }
});