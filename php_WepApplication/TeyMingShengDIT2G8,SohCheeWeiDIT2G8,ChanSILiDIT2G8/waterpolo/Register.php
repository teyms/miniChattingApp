
<?php
$PAGE_TITLE = 'Register';
include('includes/header.php');
?>


<div>
    <h1>Register</h1>

    <?php
    require_once('includes/helper.php');

    //$id='';
    $name='';
    $gender='';
    $email='';
    //$type='';
    $username='';
    $password='';
    $password2='';
    if (!empty($_POST)) // Something posted back.
    {
        $name    = trim($_POST['name']);
        $gender  = trim($_POST['gender']);
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $password2 = trim($_POST['password2']);
    
        // Validations.
        //$error['id']      = validateStudentID($id);
        $error['name']    = validateName($name);
        $error['gender']  = validateGender($gender);
        $error['email'] = validateEmail($email);
        $error['password'] = validatePassword($password);
        $error['password2'] = confirmPassword($password,$password2) ;
        $error = array_filter($error); // Remove null values.


        if (empty($error)) // If no error.
        {
            ///////////////////////////////////////////////////////////////////
            // Database insert ////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
            $con = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or
            die ('Unable to connect. Check your connection parameters.');
        
            //mysqli_select_db($db, DB_NAME) or die(mysqli_error($db));

            $sql = "
                INSERT INTO Register (RegisterName, RegisterGender, RegisterEmail,user, pass)
                VALUES ('$name', '$gender', '$email','$username','$password')
            ";
            
            if (mysqli_query($con,$sql) )
                $success = "Data inserted successfully!";
                else die(mysqli_error($con));
            
            if (mysqli_affected_rows($con)  > 0)
            {
                printf('
                    <div class="info">
                    Student <strong>%s</strong> Register successfully.
                    [ <a href="listing.php">Back to list</a> ]
                    </div>',
                    $name);

                // Reset fields.
                $id = $name = $gender = $email = $type = $username = $password = $password2 = null;
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

    <form action="" method="post">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td>
                   <?php
                    //htmlInputHidden('id', $id);
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    //htmlInputHidden('type', $type);
                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="name"> Name :</label></td>
                <td>
                    <?php htmlInputText('name', $name, 30) ?>
                </td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>
                    <?php htmlRadioList('gender', $GENDERS, $gender) ?>
                </td>
            </tr>
            <tr>
                <td><label for="email"> Email :</label></td>
                <td>
                    <?php htmlInputEmail('email', $email, 60) ?>
                </td>
            </tr>
            <tr>
                <td><label for="username"> Username :</label></td>
                <td>
                    <?php  htmlInputText('username', $username, 50) ?>
                </td>
            </tr>
            <tr>
                <td><label for="password">Password :</label></td>
                <td>
                    <?php htmlInputPassword('password', $password, 50) ?>
                </td>
            </tr>
            <tr>
                <td><label for="password2">Confirm Password :</label></td>
                <td>
                    <?php htmlInputPassword('password2', $password2, 50) ?>
                </td>
            </tr>
        </table>

        <input type="submit" name="Register" value="Register" />
        <input type="button" value="Cancel" onclick="location='home.php'" />
    </form>
</div>
<!-- End of content -->

<?php
include('includes/footer.php');
?>

