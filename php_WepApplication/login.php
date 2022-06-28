<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <title>Login</title>
</head>

<?php
//$username = "teymingsheng";
//$password = "q123456";
function loginFunc($username1, $password1)
{
  define('MYSQL_HOST', 'localhost');
  define('MYSQL_USER', 'root');
  define('MYSQL_PASSWORD', '');
  define('MYSQL_DB', 'ChatingApp');

  $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
    die('Unable to connect to DB');

  $query = "SELECT * FROM User WHERE username = '$username1' AND password = '$password1'";

  $match = mysqli_query($db, $query) or die(mysqli_error($db));
  if (mysqli_num_rows($match) == 1) {
    while ($row = mysqli_fetch_array($match)) {
      extract($row);
      $userId = $id;
      $userName = $name;
      $userGender = $gender;
      $userUsername = $username;
      $userPassword = $password;

      printf("| %d | %s | %s | %s | %s |", $userId, $userName, $userGender, $userUsername, $userPassword);
      //header("location: index.php?id=$userId");
      session_start();
      $_SESSION["uid"] = $id;
      header("location: chatList.php");
    }
  } else {
    echo '<p>Failed to Login, Username or Password Incorrect!</p>';
  }
}
// --> Note: This resolves as true even if all $_POST values are empty strings

if (isset($_POST['txtUsername']) && isset($_POST['txtPassword'])) {
  loginFunc($_POST['txtUsername'], $_POST['txtPassword']);
} else {
  echo '<p>Please enter Password and Username!</p>';
}


?>



<body>

  <div class="login-container">
    <form class="login-form" name="loginForm" action="" method="post">
      <h1>Login</h1>
      <hr class="horizontal-line">
      <div class="input-container">
        <Label>Username:</Label>
        <input type="text" id="txtUsername" name="txtUsername" value="" />
        <br /><br />
        <label>Password :</label>
        <input type="password" id="txtPassword" name="txtPassword" value="" />
        <br />
        <button type="submit" id="btnLogin" name="btnLogin" value="Login">Login</button>
    </form>
  </div>
  </div>


</body>

</html>