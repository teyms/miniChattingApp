<?php
require_once('includes/helper.php');

?>



    <?php
    require_once('includes/helper.php');
    $hideform = false;
    $id='';
    $name='';
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        //get, to retreive the id from query string.
        
        $id = strtoupper(trim($_GET['id']));
        if(empty($id)){
            $hideform=true;
        }
        
        
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
    if(!empty($_POST)){
        $id=trim($_POST['id']);
        header("location:receipt.php?id=$id");
    }
    ?>




<?php
$cardNumber="";
$ccv="";
$month="";
$year="";
$cvv="";
$cname="";
?>

<h1>Payment</h1>
<form action="<?php //echo"receipt.php?id=$id" ?>" method="post">
        <table cellpadding="5" cellspacing="0">
             <tr>
                <td>
                    <?php
                        htmlInputHidden('id', $id);
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="card">Card Numbers</label></td>
                <td>
                    <?php
                    htmlInputText('cardNumber', $cardNumber,16);
                    ?>
                </td>
            </tr>  
            <tr>
                <td><label for="cname">Card on name</label></td>
                <td>
                    <?php
                    htmlInputText('cname', $cname,30);
                    ?>
                </td>
            </tr>                
            <tr>
                <td><label for="Date">Expiration Date</label></td>
                <td>
                    <?php
                        htmlInputText('month', $month);
                    ?>
                </td>
                <td>
                    <?php
                        htmlInputText('year', $year);
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="CVV">CVV</label></td>
                <td>
                    <?php
                    htmlInputText('CVV', $cvv,3);
                    ?>
                </td>
            </tr> 
            
            
        </table>
        <input type="submit" name="update" value="Proceed" />
        <input type="button" value="Cancel" onclick="location='home.php'" />
</form>

