<?php/*
$PAGE_TITLE = 'ticket';
include('includes/header.php');*/
?>

<div>
    <h1>Waterpolo Open Cup</h1>
    
    <?php
    require_once('includes/helper.php');
    $hideform = false;
    $id='';
    $name='';
    
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
            //$team = $pTeam;
            //$category = $pcaterogy;
            $name = $RegisterName;
            //$ic = $pic;
            //$tShirt = $ptshirt;
            //$food = $pfood;
            
        }
        
        if(mysqli_num_rows($result) <= 0)
        {
            //echo 'You have to <a href="login.php">login</a> before participate.|<a href="register.php">Here to Register<a>';
 
            $hideform = true;
       }
        
        
    }
    }
        //get id and name
   if (!empty($_POST)) // Something posted back.
    {
        $id=trim($_POST['id']);
        $name=trim($_POST['name']);  
    }
    

$PAGE_TITLE = 'Ticket';
if($hideform==false){
printf("<a href='home.php'>$name 's account | </a>");
printf("<a href='home.php'>log out</a>");
}
else
{
printf("<a href='login.php'>Login | </a>");
printf("<a href='register.php'>Register</a>");    
}
include('includes/header.php');
if($hideform==true){
    echo 'You have to <a href="login.php">login</a> before participate.|<a href="register.php">Here to Register<a>';
}


        //read the value from POST
        require_once ('includes/helper.php');

    //$id='';
    $team='';
    $category='';
    $name1=[10];
    //$type='';
    $ic=[10];
    $tShirt=[10];
    $food=[10];
    for($i=0;$i<10;$i++)
    {
        $name1[$i]='';
        $ic[$i]='';
        $tShirt[$i]='';
        $food[$i]='';
    }
    //echo"123";
    if (!empty($_POST)) // Something posted back.
    {
        //$id=trim($_POST['id']);
        //$name=trim($_POST['name']);
        $team    = trim($_POST['team']);
        $category  = trim($_POST['category']);
        for($i=0;$i<10;$i++){
        $name1[$i] = trim($_POST[$nname[$i]]);
        $ic[$i] = trim($_POST[$nic[$i]]);
        $tShirt[$i] = trim($_POST[$ntShirt[$i]]);
        $food[$i] = trim($_POST[$nfood[$i]]);
        
    
        // Validations.
        //$error['id']      = validateStudentID($id);
        //$error[$nname[$i]]    = validateName($name1);
        //$error['gender']  = validateGender($gender);
        //$error['email'] = validateEmail($email);
        //$error['password'] = validatePassword($password);
        //$error['password2'] = confirmPassword($password,$password2) ;
        $bname=0;
        $lname=0;
        $pregname=0;
        //if(name[0]==0 || name[1]==0 || name[2]==0 || name[3]==0 || name[4]==0 || name[5]==0 || name[6]==0 || name[7]==0 || name[8]==0 || name[9]==0)
        ($name1[$i]==null)?$bname++:$bname+0;
        ($name1[$i]>30)?$lname++:$lname+0;
        (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $name1[$i]))?$pregname++:$pregname+0;
        ////////////////////////////////////////////////////////////
        $bic=0;
        $lic=0;
        $pregic=0;
        ($ic[$i]==null)?$bic++:$bic+0;
        ($ic[$i]>12)?$lic++:$lic+0;
        (!preg_match('/^[0-9]{12}$/', $ic[$i]))?$pregic++:$pregic+0;
        
        $bfood=0;
        ($food[$i]==null)?$bfood++:$bfood+0;
        $btshirt=0;
        ($tShirt[$i]==null)?$btshirt++:$btshirt+0;
        }
        
        if($bfood>0){
            $error['food']="Please select <strong>food</strong>";
        }
        
        
        if($bic>0){
            $error['ic']="<strong>ic no</strong> Cannot be blank";
        }
        else if($lic>12){
            $error['ic']="<strong>ic no</strong> Cannot more than 12 character";
        }
        else if($pregic>0){
            $error['ic']="There are invalid letters in <strong>ic no</strong>";
        }
        
        if($bname>0){
            $error['name']="<strong>name</strong> Cannot be blank";
        }
        else if($lname>0){
            $error['name']="<strong>name</strong> Cannot more than 30 character";
        }
        else if($pregname>0){
            $error['name']="There are invalid letters in <strong>name</strong>";
        }        
        
        if($btshirt>0){
            $error['tshirt']="Please select <strong>tshirt</strong>";
        }
        if(isset($error)){
        $error = array_filter($error); // Remove null values.
        }


        if (empty($error)) // If no error.
        {
            ///////////////////////////////////////////////////////////////////
            // Database insert ////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
            //---------------------------------------------------------------------
            for($i=0;$i<10;$i++){
            $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
        
            //mysqli_select_db($db, DB_NAME) or die(mysqli_error($db));

            $sql = "
                INSERT INTO Participant (pTeam, pCategory, Pname,Pic, Ptshirt,pfood,Registerid)
                VALUES ('$team', '$category', '$name1[$i]','$ic[$i]','$tShirt[$i]','$food[$i]','$id');
            ";
            if (mysqli_query($con,$sql) )
               $success = "Data inserted successfully!";
                else die(mysqli_error($con));
            }
            if (mysqli_affected_rows($con)  > 0)
            {
                header("location:payment.php?id=$id");
                //printf('
                   // <div class="info">
                   // Student <strong>%s</strong> Register successfully.
                  //  [ <a href="listing.php">Back to list</a> ]
                  //  </div>',
                  //  $name);

                 //Reset fields.
               // $id = $name1 = $category = $ic = $tShirt = $food = $team = null;
           }
            else
            {
                // Something goes wrong.
                echo '
                    <div class="error">
                    Opps. Database issue. Record not inserted.
                    </div>
                    ';
            }
           
            ///////////////////////////////////////////////////////////////////
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
    
    ?>
    
<!--<?php/*
$PAGE_TITLE = 'Ticket';
if($hideform==false){
printf("<a href='home.php'>$name 's account | </a>");
printf("<a href='home.php'>log out</a>");
}
else
{
printf("<a href='login.php'>Login | </a>");
printf("<a href='register.php'>Register</a>");    
}
include('includes/header.php');
if($hideform==true){
    echo 'You have to <a href="login.php">login</a> before participate.|<a href="register.php">Here to Register<a>';
}*/

?>-->
    
    
    
    
    <?php if($hideform == false) :  //to hide or show the form ?>
    <form action="" method="post">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td>
                    <?php
                        htmlInputHidden('name', $name);
                    ?>
                </td>
            </tr>            
            <tr>
                <td>
                    <?php
                        htmlInputHidden('id', $id);
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="team">Team</label></td>
                <td>
                    <?php
                    htmlInputText('team', $team,10);
                    ?>
                </td>
            </tr>


            <tr>
                <td>Category :</td>
                <td>
                    <?php htmlRadioList('category', $CATEGORY, $category) ?>
                </td>
            </tr>
            <?php
            for($i=0;$i<10;$i++){
            printf('<tr>'
                ."<td><label for='%s'>name :</label></td>"
                ."<td>",$nname[$i]);
                      htmlInputText($nname[$i], $name1[$i], 30);
            printf( "</td>"
                ."<td><label for='%s'>ic :</label></td>"
                ."<td>",$nic[$i]);
                    htmlInputText($nic[$i], $ic[$i], 12);
                    
            printf("</td>"
                 ."<td><label for='%s'> Tshirt :</label></td>"
                ."<td>",$ntShirt[$i]);
                    htmlSelect($ntShirt[$i],$TSHIRT,$tShirt[$i],'--Select One--');
            printf("</td>"
                ."<td><label for='%s'>food :</label></td>"
                ."<td>",$nfood[$i]);
                    htmlSelect($nfood[$i],$FOOD,$food[$i],'--Select One--');
            echo"</td>"
            ."</tr>";
            }
?>            
        </table>

        <input type="submit" name="update" value="payment" />
        <input type="button" value="Cancel" onclick="location='home.php'" />
    </form>
    
    <?php endif ?>
</div>

<?php
include('includes/footer.php');
?>

