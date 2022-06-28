<?php
//https://www.itsolutionstuff.com/post/php-find-url-in-text-string-and-make-link-exampleexample.html
// else{
//   $hint = "qwer";
// }
session_start();
require("dbConnect.php");

// if(isset($_SESSION['chatUserId'])){
//   echo "Nice try";
// };

$q = $_REQUEST["q"];
$uid = $_REQUEST["id"];
$hint = "";
$chatUserId = $_SESSION['chatUserId'];
$cid = "";

//isset($_REQUEST['id'])==1 ?$chatUserId=2: $chatUserId=1;


if($q != "" || $q != null){

  insertConversations($uid, $chatUserId);
  if(isset($GLOBALS['LastInsertedCid'])){
    $cid = $GLOBALS['LastInsertedCid'];
    insertUser_Conversations($uid, $chatUserId, $cid);
    insertMessages($q, $cid);
    //echo 'okok2';
  }
  else{
    $getCid = checkDataConversations($uid, $chatUserId);
    if($getCid != null){
    insertMessages($q, $getCid);
    }
    
  }
  //echo ' okok1';
  //$bool = checkDataConversations($uid, $chatUserId)==true?'true':'false';
  

  //$hint = "{$q} sent from ID {$uid}";
  $hint = "{$q}";
  echo $hint;
}





// function insertChatDB($id, $userOne, $userTwo){

//   $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
//   die ('Unable to connect to DB');
//   //$query ="SELECT * FROM Register WHERE User = '$username' AND Pass= '$password'";
//   $query = 'INSERT INTO Chats('
//        . 'id,'
//        . 'contents, toId)'
//        . "VALUES('$id', '$contents' ,'$toId')";

       

//   mysqli_query($db, $query) or die (mysqli_error($db));


// }







//check if the Conversations data between UserOne and UserTwo already exist
function checkDataConversations($userOne, $userTwo){
    $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
    die ('Unable to connect to DB');

    // $query ="SELECT * FROM Conversations 
    //         WHERE (userOne = '$userOne' OR userOne = '$userTwo') 
    //         AND (userTwo = '$userTwo' OR userTwo = '$userOne')";
    $query ="SELECT * FROM Conversations 
              WHERE (userOne = '$userOne' AND usertwo = '$userTwo')";        

    $match = mysqli_query($db, $query) or die (mysqli_error($db));

    if(mysqli_num_rows($match)==1)
    {
      while ($row = mysqli_fetch_array($match)){
      extract($row);
      $conversationsId = $cid;
      }
      return $conversationsId;
    }
      return null;
    // {return true;}
    // return false;      
}

function insertConversations($userOne, $userTwo){

  //if no record(false) found then insert, else return;
  if(checkDataConversations($userOne, $userTwo) == null){
    $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
    die ('Unable to connect to DB');
  
    $query = 'INSERT INTO Conversations('
       . 'userOne, userTwo)'
       . "VALUES('$userOne' ,'$userTwo')";

       if(mysqli_query($db, $query)){
        $GLOBALS['LastInsertedCid'] = mysqli_insert_id($db);
      }
      else {die (mysqli_error($db));}  
  }
  return;
  
}



function insertUser_Conversations($uid, $chatUserId, $cid){
  $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
  die ('Unable to connect to DB');
  
  //1 insert
  $query = 'INSERT INTO User_Conversations('
       . 'id, cid)'
       . "VALUES('$uid' ,'$cid')";

  mysqli_query($db, $query) or die (mysqli_error($db));

  //2 insert
  $query = 'INSERT INTO User_Conversations('
       . 'id, cid)'
       . "VALUES('$chatUserId' ,'$cid')";

  mysqli_query($db, $query) or die (mysqli_error($db));
}


function insertMessages($text, $cid){
  $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
  die ('Unable to connect to DB');
  
  $query = 'INSERT INTO Messages('
       . 'text, cid)'
       . "VALUES('$text' ,'$cid')";
  mysqli_query($db, $query) or die (mysqli_error($db));

}

?>

<!-- <script>
  var id = <?php //echo json_encode($_POST['id'] ?? null)?>;
</script> -->