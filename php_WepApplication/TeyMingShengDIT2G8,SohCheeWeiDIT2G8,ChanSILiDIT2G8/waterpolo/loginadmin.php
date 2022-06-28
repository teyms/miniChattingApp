<?php
$PAGE_TITLE='Admin Login';

//include('includes/headeradmin.php');
?>



<?php

require_once 'includes/helper.php';
$password='';
$username='';

if(!empty($_POST))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
                die ('Unable to connect to DB');
    //$query ="SELECT * FROM Register WHERE User = '$username' AND Pass= '$password'";
    $query ="SELECT * FROM Register WHERE User = '$username' AND Pass= '$password' AND type = 1 ";
    
    $match = mysqli_query($db, $query) or die (mysqli_error($db));
    if(mysqli_num_rows($match)==1)
    {
        while ($row = mysqli_fetch_array($match)){
            extract($row);
        $id = $RegisterId;
        $name = $RegisterName;
        $gender = $RegisterGender;
        $email = $RegisterEmail;
        $type = $Type;
        $username = $User;
        $password = $Pass;
        
    printf("| %d | %s | %s | %s | %d | %s | %s |",$id,$name,$gender,$email,$type,$username,$password); 
    header("location: listing.php?id=$id");
    }
    }
    else
    {
        printf("<p>INVALID USERNAME OR PASSWORD</p>");
        printf("<p>Only allow <strong>ADMIN</strong> to login</p>");
    }
}
//else
//{
//    printf("Username or Password Wrong");
//}

?>
<html>
    <head>
        <link rel="stylesheet" href="includes/loginadmin-style.css">   

    </head>
    <body>
    <div class="login">
    <h1>Admin Login</h1>
<form action="" method="post">
<table> 
    <tr> 
        <td><label for="username">Username :</label></td>
        <td>
        <?php htmlInputText('username', $username, 50) ?>
        </td>
    </tr>
    

    <tr>
        <td> <label for="password">Password :</label> </td>
        <td>
        <?php htmlInputPassword('password', $password, 50) ?>
        </td>
    </tr>
</table>    
<input class="btn btn-primary btn-block btn-large" type="submit" name="Login" value="Login" />
</form>
    </div>
    </body>
</html>