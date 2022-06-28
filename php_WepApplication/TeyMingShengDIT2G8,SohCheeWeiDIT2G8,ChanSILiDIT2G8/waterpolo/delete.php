<?php
//$PAGE_TITLE = 'Delete Register Acount';
//include('includes/header.php');
?>

<div>
    <h1>Delete Account</h1>
    
    <?php
    require_once('includes/helper.php');
    $hideform = false;
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        //get, to retreive the id from query string.
        if(empty($_GET['id'])){
            $hideform=true;
        }
        else{       
        $id = strtoupper(trim($_GET['id']));
        
        $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
        
        $sql = "SELECT * FROM Register WHERE RegisterID = '$id'";
        
        $result = mysqli_query($con, $sql) or die (mysqli_error($con));
        
        while($row = mysqli_fetch_array($result)){
            extract($row);
            
            //record found, read the value.
            $id = $RegisterId;
            $name = $RegisterName;
            $username = $User;
            $gender = $RegisterGender;
            $email = $RegisterEmail;
            $password = $Pass;
            $type = $Type;
        }
        
        if(mysqli_num_rows($result) <= 0)
        {
            echo 'Opps, Record not found.';
            $hideform = true;
        }
        
    }
    }
    else
    {
        $hideform = true;
        //post, update button is clicked.
        
        //read the value from POST
        if (!empty($_POST)) // Something posted back.
        {
            $id      = strtoupper(trim($_POST['id']));
            $name    = trim($_POST['name']);


                //update to database
                $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
                
               $sql="DELETE FROM Register "
                       . "WHERE RegisterID = '$id' ";
        
               
               mysqli_query($con,$sql) or die(mysqli_error($con));
               
               if (mysqli_affected_rows($con)  > 0)
            {
                printf('
                    <div class="info">
                    Student <strong>%s</strong> has been deleted.
                    [ <a href="listing.php">Back to list</a> ]
                    </div>',
                    $name);
            }
            else
            {
                // Something goes wrong.
                echo '
                    <div class="error">
                    Opps. Database issue. Record not deleted.
                    </div>
                    ';
            }

            
        
        }
        
        
        

        
    }
    

$PAGE_TITLE = 'List Of Account';
if($hideform==false){
printf("<a href='listing.php'>$name 's account | </a>");
printf("<a href='loginadmin.php'>log out</a>");
}
include('includes/headeradmin.php');
if($hideform==true){
    echo 'You have to <a href="loginadmin.php">login</a> before check the record.';
}

    
    ?>
    
    
    <?php if($hideform == false) :  //to hide or show the form ?>
    <form action="" method="post">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td><label for="id">Student ID :</label></td>
                <td>
                    <?php
                        echo $id;
                        htmlInputHidden('id', $id);
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="name">Student Name :</label></td>
                <td>
                    <?php echo $name;
                    htmlInputHidden('name', $name) ?>
                </td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>
                    <?php echo $GENDERS[$gender]; ?>
                </td>
            </tr>
            <tr>
                <td><label for="email">Program :</label></td>
                <td>
                    <?php echo $email; ?>
                </td>
            </tr>
            <tr>
                <td><label for="type">Program :</label></td>
                <td>
                    <?php echo $type; ?>
                </td>
            </tr>
            <tr>
                <td><label for="username">Program :</label></td>
                <td>
                    <?php echo $username; ?>
                </td>
            </tr>
            <tr>
                <td><label for="password">Program :</label></td>
                <td>
                    <?php echo $password; ?>
                </td>
            </tr>            
        </table>

        <input type="submit" name="delete" value="Yes" />
        <input type="button" value="Cancel" onclick="location='listing.php'" />
    </form>
    
    <?php endif ?>
</div>

