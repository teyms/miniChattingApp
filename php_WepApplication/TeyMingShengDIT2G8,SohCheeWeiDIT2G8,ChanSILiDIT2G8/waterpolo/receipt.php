  <?php
    require_once('includes/helper.php');
    $hideform = false;
    $id='';
    $name='';
    $category='';
    $team='';
    
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
    ?>
    
     <?php 
        require_once('includes/helper.php');
        
        $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
                die ('Unable to connect to DB');
        
        //$sql = "SELECT RegisterName,pTeam,Pcategory FROM Register R,Participant P WHERE R.RegisterId='$id' AND R.RegisterId=P.RegisterId";
        $sql = "SELECT pTeam,Pcategory FROM participant where registerid='$id'";
        $result = mysqli_query($db, $sql) or die (mysqli_error($db));
        
        while ($row = mysqli_fetch_array($result)){
            extract($row);
            //$name=$RegisterName;
            $team=$pTeam;
            $category=$Pcategory;
            /*printf('<tr>'
                    . '<td style=text-align:center;>%d</td>'
                    . '<td>%s</td>'
                    . '<td>%s</td>'
                    . '<td>%s</td>'
                    . '<td>%d</td>'
                    . '<td>%s</td>'
                    . '<td>%s</td>'
                    . '<td>'
                    . '<a href="delete.php?id=%s">Delete</a> | '
                    . '<a href="update.php?id=%s">Edit</a>'
                    .'</td>'
                    . '</tr>', $RegisterId, $RegisterName,$GENDERS[$RegisterGender], $RegisterEmail,$Type,$User,
                                $Pass,$RegisterId,$RegisterId);*/
        }
        printf("<table>");
        printf("<tr><td>Team Name:<strong>%s</strong></td>                                 <td>Category:<strong>%s</strong>              </td></tr>",$team,$CATEGORY[$category]);
        printf("<tr><td>DATE:                              <td>VENUE:                             <td></tr><br>");
        printf("<tr><td>FROM:20/11/2019</td>                      <td>TARUC Swimming Pool,KL main campus,</td></tr><br>");
        printf("<tr><td>TO:23/11/2019</td>                        <td>Jalan Genting Kelang,Setapak, KL.  </td></tr><br>");
        printf("<tr><td>Total Amount:<strong>MYR330</strong></td>                  <td>Payment make by <strong>%s</strong> </td></tr>",$name);
        printf("</tr></table>");
        echo"<br><br>";
        /*printf('<tr>'
                . '<td colspans="4">'
                . '%d record(s) returned.'
                . '</td>'
                . '</tr>', mysqli_num_rows($result));*/
        
        
        
        ?>
<a href="<?php echo"home.php?id=$id" ?>">Return To Home</a>

