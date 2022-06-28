<?php 

$uid = $_REQUEST["id"]; 


//$_COOKIE['targetChat'] = $uid;

setcookie('targetChat', strval($uid), time()+3600, '/');

?>
<script>
console.log( "from cookies.php ");
</script>