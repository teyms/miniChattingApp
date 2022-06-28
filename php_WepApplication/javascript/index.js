var count = 0;
function insertChat(uid) {

  //var className = ""
  var str = document.getElementById("chat_input").value;

  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {
        count++;

        // var idName = "chat_list"+count.toString();
        // const getChatParent = document.getElementById("chat_list_parent");
        // var chatList = document.createElement("li");
        // chatList.setAttribute("id",idName);

        // getChatParent.appendChild(chatList);
        // document.getElementById(idName).innerHTML = this.responseText;
        insertMsgBlock(this.responseText,true);        

      }
    };
    xmlhttp.open("GET", "include/InsertChatAjax.php?q=" + str + "&id=" + uid, true);
    xmlhttp.send();
  }

  document.getElementById("chat_input").value = " ";
}


// create message block in web UI//
function insertMsgBlock(textMessages, right){  
  const getChatParent = document.getElementById("chat_list_parent");
  var count = getChatParent.childElementCount;
  count++;
  //console.log('right?');
  //var count = incrementNo;
  var idName = "chat_list"+count.toString();
  
  var chatList = document.createElement("li");
  chatList.setAttribute("id",idName);
  
  if(right === true){
    chatList.setAttribute("class","right");
  }

  
  //chatList.setAttribute("style","float:right; clear:both;");
  getChatParent.appendChild(chatList);
  document.getElementById(idName).innerHTML = textMessages;

}







//ajax to update cookie in php
function UpdateCookies(uid) {


  //var str = document.getElementById("chat_input").value;

  //if (str.length == 0) {
    //document.getElementById("txtHint").innerHTML = "";
    //return;
  //} else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {
        // count++;
        // var idName = "chat_list"+count.toString();
        // const getChatParent = document.getElementById("chat_list_parent");
        // var chatList = document.createElement("li");
        // chatList.setAttribute("id",idName);
        // getChatParent.appendChild(chatList);
        // document.getElementById(idName).innerHTML = this.responseText;

      }
    };
    xmlhttp.open("GET", "include/cookies.php?id=" + uid, true);
    xmlhttp.send();
  //}

  //document.getElementById("chat_input").value = " ";
}










     
  // Function to create the cookie
  function createCookie(name, value, days) {
      var expires;
        
      if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
      }
      else {
          expires = "";
      }
        
      document.cookie = escape(name) + "=" + 
          escape(value) + expires + "; path=/";
  }
    



