<head>
    <link rel="stylesheet" href="includes/login-style.css">
</head>
<?php
$PAGE_TITLE='User Login';

include('includes/header.php');
?>

<h1>User Login</h1>

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
    $query ="SELECT * FROM Register WHERE User = '$username' AND Pass= '$password' AND type = 0 ";
    
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
    header("location: home.php?id=$id");
    }
    }
    else
    {
        printf("INVALID USERNAME OR PASSWORD\n");
        printf("<a href='Register.php'>Register an account here.</a>");
    }
}
//else
//{
//    printf("Username or Password Wrong");
//}

?>
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
        <div class="row align-items-center remember">
            <input type="checkbox">Remember Me
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-large" name="Login" value="Login">Let me in.</button>
        <div class="fgt">
            <a class="pwd" href="#">Forgot your password?</a>
        </div>
</form>
</html>
</form>  

<?php
include('includes/footer.php');
?>