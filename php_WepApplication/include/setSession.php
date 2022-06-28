<?php 

session_start();
if(isset($_POST['key1'])){
  echo "Nice try";
  $get = trim($_POST['key1']);
  $getName = trim($_POST['key2']);
  $_SESSION['chatUserId'] = $get;
  $_SESSION['chatUserName'] = $getName;
  //echo $_SESSION['chatUserId'];
}


//json_encode(array("name"=>"John","time"=>"2pm"));
?>

<script>
  alert("success " + $get);
</script>