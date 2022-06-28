<?php
session_start();

    // $username = "teymingsheng";
    // $password = "q123456";
  //require("include/dbConnect.php"); 
  require("include/readChat.php"); 
    



    // if(isset($_SESSION['chatUserId'])){
    //   echo "fuiyohh";
    // }
    // else{
    //   echo "haiyaaa";
    // }

    $uid = "";
    //if(isset($_SESSION["uid"]) && isset($_SESSION['getUID'])){
    if(isset($_SESSION["uid"]) && isset($_SESSION['chatUserId'])){
      $uid = trim($_SESSION['uid']);
      $chatUserId = trim($_SESSION['chatUserId']);
      $chatUserName = trim($_SESSION['chatUserName']);
      
      //isset($_REQUEST['id'])==1 ?$chatUserId=2: $chatUserId=1;

    }
    





?>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="javascript/index.js"></script>
<script>
  $(document).ready(function(){
    <?php 
        //check if any existing messages available in the DB 
        $getConversationsDb =  getConversations($uid,$chatUserId);
        if($getConversationsDb != null){
          $cid = $getConversationsDb;
          //echo "we got it {$getConversationsDb}";
          $getMessages = getMessages($cid);
          foreach ($getMessages as $key) {
            //echo $key->getText(); echo "<br>";
            if($key->getCid() == $uid){
              //echo "<script type='text/javascript'>insertMsgBlock({$key->getText()}, true);</script>";
              echo "insertMsgBlock('{$key->getText()}', true);";
            }
            else{
              //echo "<script type='text/javascript'>insertMsgBlock({$key->getText()}, false);</script>";
            echo "insertMsgBlock('{$key->getText()}', false);";
            }
            
          }
          
        }  

    ?>
  });

      //scroll to bottom
      // const chatboxSelect = document.querySelector(".chatbox");
      //const chatboxSelect = document.getElementsByClassName(".chatbox");
      //$(document).ready(chatboxSelect.scrollTop = chatboxSelect.scrollHeight);
      //$(document).ready(window.scrollTo(0, document.body.scrollHeight));
</script>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatBox</title>
  <script src="javascript/index.js" async></script>
  <link rel="stylesheet" href="css/index.css">

</head>
<body>

  <div class="container">

    <div class="chat-person"><?php echo $chatUserName ?></div>

    <div class="chatbox">
     <ul id="chat_list_parent">
       <!-- <li id="testChat" value="123"></li> -->
        <?php 
        // $content = "";
        // if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          
        //   $content .= "<li> {$_POST['chat_input']} </li>";
        //   //echo "<li> {$_POST['chat_input']} </li>";
        // }

        // echo $content;
        ?>
      </ul>
    </div>
    
    <br/>

    <div class="chat_input">
      <!-- <form name="form" action="" method="post"> -->
        <input type="text" name="chat_input" id="chat_input" value="" onkeyup=""/>
        <input type="submit" name="send" id="submit-btn" value="Send" onclick="insertChat(<?php echo $uid?>)" />
      <!-- </form> -->
    </div>

  </div>

  <script defer>

  

  // function insertMsgBlock(textMessages){  
  //   const getChatParent = document.getElementById("chat_list_parent");
  //   var count = getChatParent.childElementCount;
  //   count++;
  //   console.log('right?');
  //   //var count = incrementNo;
  //   var idName = "chat_list"+count.toString();
    
  //   var chatList = document.createElement("li");
  //   chatList.setAttribute("id",idName);
  //   //chatList.setAttribute("style","float:right; clear:both;");
  //   getChatParent.appendChild(chatList);
  //   document.getElementById(idName).innerHTML = textMessages;

  // }
  // console.log('qwerrr');

  //insertMsgBlock("wowowo");
  //insertMsgBlock("wowowo");
      
  </script>

  <?php


  ?>


</body>
</html>

