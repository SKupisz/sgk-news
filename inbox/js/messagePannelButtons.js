function failedComment(Title,bodyContent){
    Push.create(Title,{
      body: bodyContent,
      icon: "./main/logo.png"
    });
  }
if(document.querySelector(".messagesPanel")){
    document.querySelector(".makeUnreaded").addEventListener("click",function(){
        if(localStorage.toEdit.length > 0){
            let forSearch = localStorage.toEdit.split(";");
            for(let i = 0 ; i < forSearch.length; i++){
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.status == 200 && this.readyState == 4){
                        let resp = this.response;
                        if(resp == "unreaded"){
                            document.getElementById(forSearch[i]).parentElement.parentElement.parentElement.classList.add("not-readed");
                        }
                        else{
                            if(resp == "wrong id"){
                                failedComment("Marking message","Wrong id error. Try again");
                            }
                            else if(resp == "Lost connection"){
                                failedComment("Marking message","Lost connection. Try later");   
                            }
                        }
                    }
                }
                let forSending = forSearch[i];
                forSending = forSending.substring(7);
                xmlhttp.open("GET","./inbox/goAndReread.php?id="+forSending);
                xmlhttp.send();
            }
            failedComment("Marking message","Marking completed");
        }
    });
    document.querySelector(".delete").addEventListener("click",function(){
        if(localStorage.toEdit.length > 0){
            let forSearch = localStorage.toEdit.split(";");
            for(let i = 0 ; i < forSearch.length; i++){
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
}
/*
    document.querySelector(".blocker").addEventListener("click",function(){
        let forSearch = localStorage.toEdit.split(";");
        for(let i = 0 ; i < forSearch.length; i++){
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.status == 200 && this.readyState == 4){
                    let resp = this.response;
                    if(resp == "user blocked"){
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
            let forSending = forSearch[i].substring(7);
            xmlhttp.open("GET","./inbox/")
        }
    });*/