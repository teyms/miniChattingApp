<?php 

require("dbConnect.php");

// if(getConversations(1,2)!=null){
//   $qwer = getConversations("1","2");
//   ////$q = array();
//   //$q = getMessages($qwer[0]);
//   $q = getMessages($qwer);
//   ////echo "nice {$qwer}\n" ;
//   echo count($qwer);
//   echo "<br/>";
//   echo count($q);
//   echo "<br/>";
//   foreach ($q as $key) {
//     echo $key->getText(); echo "<br>";
    
//   }
//   //echo $q[0]->getText();
// }
// else{
//   echo 'not good';
// }

function getConversations($loginUser, $chatUser){
  //$loginUserConverted = intval($loginUser);
  //$chatUserConverted = intval($chatUser);

  $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
  die ('Unable to connect to DB');

  $sql = $db->prepare("SELECT * FROM conversations
        WHERE (userOne = ? OR userOne = ?) 
        AND (userTwo = ? OR userTwo = ?)");

  $sql->bind_param("iiii", $loginUser, $chatUser, 
                    $chatUser, $loginUser);
  $sql->execute();
  $result = $sql->get_result();
  //$match = mysqli_query($db, $sql) or die (mysqli_error($db));

  if(mysqli_num_rows($result)>0)
  {
    $i=0;
    while ($row = mysqli_fetch_array($result)){
    extract($row);

    $array[$i] = $cid;
    //$messagesId[$i] = $mid;
    //$messages[$i] = $text;
    $i++;
    }
    $sql->close();
    $db->close();
    return $array;
  }
  $sql->close();
  $db->close(); 
  return null;
  // if(mysqli_num_rows($result)==1)
  // {
  //   while ($row = mysqli_fetch_array($result)){
  //   extract($row);
  //   $conversationsId = $cid;
  //   }
  //   $sql->close();
  //   $db->close();
  //   return $conversationsId;
  // }
  // $sql->close();
  // $db->close();
  // return null;
  


}

//https://stackoverflow.com/questions/9141095/insert-data-into-a-2d-array
function getMessages($cid){

  $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
  die ('Unable to connect to DB');

  $sql = $db->prepare("SELECT * FROM Messages WHERE cid = ? Or ? Order by mid asc");
  $sql->bind_param("ii", $cid[0], $cid[1]);

  $sql->execute();
  $result = $sql->get_result();
  //$match = mysqli_query($db, $sql) or die (mysqli_error($db));

  if(mysqli_num_rows($result) > 0)
  {
    $i=0;
    while ($row = mysqli_fetch_array($result)){
    extract($row);

    $array[$i] = new Messages($mid, $text, $cid);
    //$messagesId[$i] = $mid;
    //$messages[$i] = $text;
    $i++;
    }
    $sql->close();
    $db->close();
    return $array;
  }
  $sql->close();
  $db->close(); 
  return '<p>Something went wrong. Please try again later!</p>';

}


class Messages{
  private $mid;
  private $text;
  private $cid;

  function __construct($mid, $text, $cid){
    $this->mid = $mid;
    $this->text = $text;
    $this->cid = $cid;
  }

  function getMid(){
    return $this->mid;
  }

  function getText(){
    return $this->text;
  }

  function getCid(){
    return $this->cid;
  }

}






?>