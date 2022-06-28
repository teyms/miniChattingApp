<?php
$PAGE_TITLE = 'Delete Participant';
//include('includes/header.php');
?>

<div>
    <h1>Delete Participant</h1>
    
    <?php
    require_once('includes/helper.php');
    $hideform = false;
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
                //if(empty($_GET['id'])){
            //$hideform=true;
        //}
        //get, to retreive the id from query string.
        //else{
        $ic = strtoupper(trim($_GET['ic']));
        
        $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
        
        $sql = "SELECT * FROM Participant WHERE Pic = '$ic'";
        
        $result = mysqli_query($con, $sql) or die (mysqli_error($con));
        
        while($row = mysqli_fetch_array($result)){
            extract($row);
            
            //record found, read the value.
            $team = $pTeam;
            $category = $Pcategory;
            $name = $Pname;
            $ic = $Pic;
            $tShirt = $Ptshirt;
            $food = $Pfood;
            $id=$RegisterId;
        }
        
        if(mysqli_num_rows($result) <= 0)
        {
            echo 'Opps, Record not found.';
            $hideform = true;
        }
        
        }
    //}
    else
    {
        $hideform = true;
        //post, update button is clicked.
        
        //read the value from POST
        if (!empty($_POST)) // Something posted back.
        {
            $id      = strtoupper(trim($_POST['id']));
            $team = trim($_POST['team']);
            //$category = trim($_POST['category']);
            //$name    = trim($_POST['name']);
            //$ic = trim($_POST['ic']);
            //$tShirt = trim($_POST['tshirt']);
            //$food= trim($_POST['food']);


                //update to database
                $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
                
               $sql="DELETE FROM Participant "
                       . "WHERE Pic = '$ic' ";
        
               
               mysqli_query($con,$sql) or die(mysqli_error($con));
               
               if (mysqli_affected_rows($con)  > 0)
            {
                printf('
                    <div class="info">
                    Student <strong>%s</strong> has been deleted.
                    [ <a href="listpar.php">Back to list</a> ]
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
    
    
    <?php //if($hideform == false) :  //to hide or show the form ?>
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
                <td><label for="team">Team name :</label></td>
                <td>
                    <?php echo $team;
                    htmlInputHidden('team', $team) ?>
                </td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>
                    <?php echo $CATEGORY[$category]; ?>
                </td>
            </tr>
            <tr>
                <td><label for="name">Name :</label></td>
                <td>
                    <?php echo $name;
                    htmlInputHidden('name', $name) ?>
                </td>
            </tr>
            <tr>
                <td><label for="ic">Ic No :</label></td>
                <td>
                    <?php echo $ic;
                    htmlInputHidden('ic', $ic) ?>
                </td>
            </tr>
             <tr>
                <td>Tshirt :</td>
                <td>
                    <?php echo $TSHIRT[$tShirt]; ?>
                </td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>
                    <?php echo $FOOD[$food]; ?>
                </td>
            </tr>          
        </table>

        <input type="submit" name="delete" value="Yes" />
        <input type="button" value="Cancel" onclick="location='listpar.php'" />
    </form>
    
    <?php //endif ?>
</div>

