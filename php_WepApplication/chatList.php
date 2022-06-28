<?php
session_start();

//echo "wowowowowowowo";
$GLOBALS['uid'] = "";
$dispaly = '';
$uid1 = null;
if (isset($_SESSION["uid"])) {
  //unset($_SESSION['uid']);
  $uid1 = trim($_SESSION["uid"]);
  $GLOBALS['uid'] = $uid1;
}
//echo $uid1;









function getChatListDB($uid)
{
  define('MYSQL_HOST', 'localhost');
  define('MYSQL_USER', 'root');
  define('MYSQL_PASSWORD', '');
  define('MYSQL_DB', 'ChatingApp');

  $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
    die('Unable to connect to DB');

  $query = "SELECT * FROM User WHERE id != '$uid'";

  $match = mysqli_query($db, $query) or die(mysqli_error($db));
  if (mysqli_num_rows($match) > 1) {
    while ($row = mysqli_fetch_array($match)) {
      extract($row);
      $userId = $id;
      $name = $name;
      //printf("| %d | %s | %s | %s | %s |",$userId,$userName,$userGender,$userUsername,$userPassword); 
      //printf("| %d | %s |",$userId,$name); 
      //header("location: index.php?id=$userId");
      //session_start();
      //$_SESSION["uid"] = $id;
      //header("location: chatList.php");
      echo createChatListTable($userId, $name);
    }
  } else {
    echo "No Record Found";
  }
}

///////////////////////////////////////////////////

function createChatListTable($userId, $username)
{
  // $table = "<tr id='{$userId}' class='chat-list' '>
  //                   <td style='border: 1px solid;'>{$userId}</td>
  //                   <td style='border: 1px solid;'>{$username}</td>
  //               </tr>";
  $table = "<tr id='{$userId}' class='chat-list' '>
              <td>{$userId}</td>
              <td>{$username}</td>
            </tr>";
  return $table;
}

///////////////////////////////////////////////

function redirect($targetChatUser)
{
  //session_start();
  $_SESSION["targetChatUser"] = $targetChatUser;
  //$_SESSION["uid"] = $uid1;
  if (isset($_SESSION["targetChatUser"])) {
    header("location: index.php?id={$targetChatUser}");
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  <script src="https://code.jquery.com/jquery.min.js"></script>

  <script src="javascript/index.js" defer></script>
  <title>Chat List</title>



</head>

<body style="display:<?php !empty($uid1) ? NULL : $display = 'none'; ?>;">
  <div class="chat-list-container">
    <h1 class="chat-list-title">Chat list </h1>
    <hr class="horizontal-line">

    <table id="chat-table">
      <tr class="chat-row-title">
        <td>ID</td>
        <td>Name</td>
      </tr>

      <?php
      //build the chat-list-friends
      $getChatList =  getChatListDB(trim($uid1));
      ?>

    </table>
  </div>

  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script async>



    const table = document.querySelector("table");
    var rows = table.rows;

    for (i = 1; i < rows.length; i++) {
      rows[i].addEventListener("click", mouseClick, false);
      rows[i].myParam = i;
      //rows[i].style.color="yellow";

    }

    function mouseClick(evt) {
      //console.log("MouseCLick"+evt.currentTarget.id);
      console.log("MouseCLick " + evt.currentTarget.children.length);
      var collect = evt.currentTarget.children;
      console.log("MouseCLick1 " + collect[1].innerText);
      //console.log("MouseCLick1 "+evt.currentTarget.childNodes[2].innerText);

      // get the clicked user and sent it to the index.php page
      //$_SESSION['getUID'] = trim(collect[0].innerText);


      $.post('include/setSession.php', {
        key1: collect[0].innerText, key2: collect[1].innerText
      }).done(function(data) {
        alert("success" + data + "   " + collect[0].innerText);
        <?php $_SESSION["uid"] = $GLOBALS['uid'] ?>
        window.location.href = "index.php";

      });

      // $.post('include/setSession.php', { key1: (collect[0].innerText).trim()}, 
      // function(data,status,result) {
      //     if(status == 'success'){
      //       window.location.href = "index.php";
      //       //var getChatUser = '<?php //echo $getchatUser;
                                    ?>';
      //       //console.log(getChatUser + "doneeee");
      //     }else{
      //       alert('Something went wrong, please try again!')
      //     }
      // });

      //window.location.href = "index.php";
      //window.location.href = "index.php?id="+collect[0].innerText;




    }

    // function clicked(evt){
    //   var targetChatUser = evt.currentTarget.id;
    //   console.log(targetChatUser+"sadfsadfsdafasdf");
    //   createCookie("targetChat", targetChatUser, '10');
    //   UpdateCookies(targetChatUser);
    //   //console.log(document.cookie +" what? " + <?php //echo  $_COOKIE['targetChat']
                                                    ?>);
    //   //var getCookies = createCookie("targetChat", targetChatUser, '10');
    //   //document.cookie = "targetChat=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    //   //var result ="<?php //redirect($_GET['targetChat']); 
                        ?>";

    //   <?php  //if(isset($_GET['targetChat'])){redirect($_GET['targetChat']);}  
          ?>
    //   //document.write(result);
    // }


    var $elems = $('.chat-list');
    var getVal;
    $elems.on('click', function(e) {
      var nth = $elems.index(this);

      //const collection = document.getElementsByClassName(".chat-list").rows.length;
      //console.log('childlist '+collection);//collection[2].text
      //var qwer3 = e.currentTarget.id;
      var qwer3 = e.currentTarget.childNodes[1].nodeValue;
      console.log("id " + qwer3);
      //window.location.href = "index.php?id="+elemA+"";
      //id={$targetChatUser}


      $elems1 = $('.chat-list:nth-child(' + nth + ')');
      var qwer2 = $elems1.children('td:nth-child(2)').innerHTML;
      console.log("elems1 " + qwer2);
      console.log(nth);

      var qwer1 = $elems.children('td:nth-child(2)').text();
      console.log("who is this " + qwer1);
      var qwer = $elems.children('#' + (nth + 2) + ' td:nth-child(' + (nth + 1) + ')').text();
      console.log(qwer);

      // $.ajax({
      //   url: "test.php",
      //   type: "POST",
      //   data:{"uid":myVar,"name":myname}
      // }).done(function(data) {
      //     console.log(data);
      // });

      // $("button").click(function(){
      // $.ajax({url: "demo_test.txt", success: function(result){
      //   $("#div1").html(result);
      //   }});
      // });










      //$elems.children('#2 td:nth-child('+nth+2+')').css( "color", "blue" );
      //$elems.children('#2 td:nth-child(1)').css( "color", "blue" );        
      // switch (nth) {
      //   case 0:
      //     //vid.currentTime = 1700;
      //     console.log(nth,$('.chat-list:nth-child('+nth+')').css( "color", "blue" ));
      //     var qwer = $elems.children('#2 td:nth-child(1)').text();
      //     console.log(qwer);
      //     //$('.chat-list:nth-child('+nth+')').css( "color", "blue" );
      //     $elems.children('#2 td:nth-child(1)').css( "color", "blue" );
      //     break;
      //   case 1:
      //     console.log(nth,$('.chat-list:nth-child('+nth+')').innerText);
      //     break;
      //   default:
      //     console.log("why?");
      //     break;
      //}

    });

    //     $(document).ready(function(){
    //   var id = 23; 
    // $("#submit").click(function(){
    //  $.ajax(
    //     {
    //     url: "B.php",
    //     type: "POST",

    //     data: { id1: id},
    //     success: function (result) {
    //             alert('success');

    //     }
    // });     
    //    });
    //   });

    // function clicked(targetChatUser){
    //   console.log(targetChatUser+"sadfsadfsdafasdf");
    //   createCookie("targetChat", targetChatUser, '10');
    //   //var getCookies = createCookie("targetChat", targetChatUser, '10');
    //   //document.cookie = "targetChat=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    //   ////var result ="<?php ////redirect($_GET['targetChat']); 
                          ?>"
    //   //document.write(result);
    // }
  </script>


</body>

</html>