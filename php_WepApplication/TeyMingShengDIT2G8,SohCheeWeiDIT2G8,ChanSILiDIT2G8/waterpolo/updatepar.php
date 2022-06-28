<?php
$PAGE_TITLE = 'Update Participant';
//include('includes/header.php');
?>

<div>
    <h1>Update Participant</h1>
    
    <?php
    require_once('includes/helper.php');
    $hideform = false;
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        //get, to retreive the id from query string.
        //if(empty($_GET['id'])){
           // $hideform=true;
        //}
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
        //post, update button is clicked.
        
        //read the value from POST
        if (!empty($_POST)) // Something posted back.
        {
            $team      = strtoupper(trim($_POST['team']));
            $category    = trim($_POST['category']);
            $name = trim($_POST['name']);
            $ic  = trim($_POST['ic']);
            $tShirt = trim($_POST['tshirt']);
            $food = trim($_POST['food']);
            $id = trim($_POST['id']);
        
            //Validation
            //$error['id']      = validateStudentID($id);
            $error['name']    = validateName($name);
            //$error['username']    = validateStudentName($username);
            //$error['gender']  = validateGender($gender);
            //$error['email'] = validateEmail($email);
            //$error['password']    = validatePassword($Pwd);
            $error = array_filter($error); // Remove null values.

            //if no error update to DB
            if (empty($error)) // If no error.
            {
                //update to database
                $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
                
               $sql="UPDATE Participant "
                       . "SET pTeam = '$team', Pcategory = '$category' ,Pname = '$name', Pic = '$ic', Ptshirt = '$tShirt', pfood = '$food' WHERE Pic = '$ic'";
        
               
               mysqli_query($con,$sql) or die(mysqli_error($con));
               
               if (mysqli_affected_rows($con)  > 0)
            {
                printf('
                    <div class="info">
                    Participant <strong>%s</strong> has been updated.
                    [ <a href="listpar.php">Back to list</a> ]
                    </div>',
                    $name);
            }
            else
            {
                // Something goes wrong.
                echo '
                    <div class="error">
                    Opps. Database issue. Record not updated.
                    </div>
                    ';
            }
                
            }
            else // Input error detected. Display error message.
            {
                echo '<ul class="error">';
                foreach ($error as $value)
                {
                    echo "<li>$value</li>";
                }
                echo '</ul>';
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
                <td><label for="id">Register Id :</label></td>
                <td>
                    <?php
                        echo $id;
                        htmlInputHidden('id', $id);
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="team">Team :</label></td>
                <td>
                    <?php htmlInputText('team', $team, 10) ?>
                </td>
            </tr>

            <tr>
                <td>Category :</td>
                <td>
                    <?php htmlRadioList('category', $CATEGORY, $category) ?>
                </td>
            </tr>
            <tr>
                <td><label for="name">name :</label></td>
                <td>
                    <?php htmlInputText('name', $name, 30) ?>
                </td>
            </tr>
            
            <tr>
                <td><label for="ic">Ic No :</label></td>
                <td>
                    <?php htmlInputText('ic', $ic, 12) ?>
                </td>
            </tr>
            <tr>
                <td>Tshirt :</td>
                <td>
                    <?php htmlSelect('tshirt', $TSHIRT, $tShirt,'--Select one--') ?>
                </td>
            </tr>
            <tr>
                <td>food :</td>
                <td>
                    <?php htmlSelect('food', $FOOD, $food,'--Select one--') ?>
                </td>
            </tr>            
        </table>

        <input type="submit" name="update" value="Update" />
        <input type="button" value="Cancel" onclick="location='listing.php'" />
    </form>
    
    <?php endif ?>
</div>
