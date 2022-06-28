<html>
    
    <head>
   <style>
            
       /*body{
                background-image: url(includes/img/img.png);
          }*/
          .contact-title{
                text-align: center;
                margin-top: 100px;
                color: #fff;
                text-transform: cover;
                transition: all 4s ease-in-out;
          }
          .contract-title h1{
                font-size: 32px;
                line-height: 10px;
          }
          form{
              margin-top: 50px;
              transition: all 4s ease-in-out;
              background-image: url(includes/img/pexels-photo-1308624.jpeg);
          }
          .form-control{
              width: 600px;
              background: transparent;
              border: none;
              outline: none;
              border-bottom:1px solid gray;
              color: #fff;
              font-size: 18px;
              margin-bottom: 16px;
          }
          input{
              height: 45px;
          }
          form.submit{
              background: #ff5722;
              border-color: transparent;
              color: #fff;
              font-size: 20px;
              font-weight: bold;
              letter-spacing: 2px;
              height: 50px;
              margin-top: 20px;
              
          }
          form.submit:hover{
              background-color: #f44336;
              cursor: pointer;
          }
        </style>
    </head>

<?php  
    require_once('includes/helper.php');
    $hideform = false;
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        if(empty($_GET['id'])){
            $hideform=true;
        }
        else{
        //get, to retreive the id from query string.
        $id = trim($_GET['id']);
        //$username = strtoupper(trim($_GET['username']));
        //$password = strtoupper(trim($_GET['password']));
        
        $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
        
        $sql = "SELECT * FROM Register WHERE RegisterID = '$id'";
        //$sql = "SELECT * FROM Register WHERE User = '$username' AND Pass = '$password'";
        
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
        
//        if(mysqli_num_rows($result) <= 0)
//        {
//            echo 'Opps, Record not found.';
//            $hideform = true;
//        }
          //printf("| %d | %s | %s | %s | %d | %s | %s |",$id,$name,$gender,$email,$type,$username,$password); 
        }
        
    }
?>

<?php
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

     <body>
        <?php
        include('includes/body.php');
        ?>
<?php if($hideform == false) : ?>
<div>
    <table align="center" class="content-table" border="1" cellspacing="0" cellpadding="5" >
        <thead>
        <tr>
            <th>Team Name</th>
            <th>Category</th>
            <th>Participate Name</th>
            <th>IC NO</th>
            <th>Tshirt</th>
            <th>Food</th>
            <th>Register Id</th>     
        </tr>
    </thead>
    <tbody>
        
        <?php 
        require_once('includes/helper.php');
        
        $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
                die ('Unable to connect to DB');
        
        $sql = 'SELECT * FROM participant';
        $result = mysqli_query($db, $sql) or die (mysqli_error($db));
        
        while ($row = mysqli_fetch_array($result)){
            extract($row);
            
            printf('<tr>'
                    . '<td style=text-align:center;>%s</td>'
                    . '<td>%s</td>'
                    . '<td>%s</td>'
                    . '<td>%s</td>'
                    . '<td>%s</td>'
                    . '<td>%s</td>'
                    . '<td>%s</td>'
                    . '<td>'
                    . '<a href="deletepar.php?ic=%s">Delete</a> | '
                    . '<a href="updatepar.php?ic=%s">Edit</a>'
                    .'</td>'
                    . '</tr>', $pTeam, $Pcategory,$Pname, $Pic,$Ptshirt,$Pfood,
                                $RegisterId,$Pic,$Pic);
        }
        
        printf('<tr>'
                . '<td colspans="4">'
                . '%d record(s) returned.'
                . '</td>'
                . '</tr>', mysqli_num_rows($result));
        
        
        
        ?>
    </tbody>
    </table>
</body>
     <?php endif ?>
</div>