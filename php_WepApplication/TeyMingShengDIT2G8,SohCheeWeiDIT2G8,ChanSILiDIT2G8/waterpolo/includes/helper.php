<?php

///////////////////////////////////////////////////////////////////////////////
// Database connection details ////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Constants. Please change accordingly.
define('MYSQL_HOST','localhost');
define('MYSQL_USER','root');
define('MYSQL_PASSWORD','');
define('MYSQL_DB','Waterpolo');

// Retuen an array of all food
$nname = array('name1','name2','name3','name4','name5','name6','name7','name8','name9','name10');
$nic = array('ic1','ic2','ic3','ic4','ic5','ic6','ic7','ic8','ic9','ic10');
$ntShirt = array('tshirt1','tshirt2','tshirt3','tshirt4','tshirt5','tshirt6','tshirt7','tshirt8','tshirt9','tshirt10');
$nfood = array('food1','food2','food3','food4','food5','food6','food7','food8','food9','food10');
function getFood()
{
    return array(
        'H' => 'Halal',
        'N' => 'Non-Halal',
        'V' => 'Vegetarian'
    );
}

//Retuen an array of all cagtegory
function getCategory()
{
    return array(
        'WO' => 'Women Open',
        'MO' => 'Men Open',
        
    );
}

// Return an array of all t-shirt size
function getTShirt()
{
    return array(
        'XS' => 'XS',
        'S' => 'S',
        'M' => 'M',
        'L' => 'L',
        'XL' => 'XL',
        'XXL' => 'XXL',
        'XXXL' => 'XXXL',
    );
}

// Return an array of all genders.
function getGenders()
{
    return array(
        'F' => 'Female',
        'M' => 'Male'
    );
}

// Array versions of lookup tables.
$GENDERS = getGenders();
$FOOD = getFood();
$TSHIRT = getTShirt();
$CATEGORY = getCategory();

///////////////////////////////////////////////////////////////////////////////
// HTML helpers ///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Print a <select> element.
function htmlSelect($name, $items, $selectedValue = '', $default = '')
{
    printf('<select name="%s" id="%s">' . "\n",
           $name, $name);

    if ($default != null)
    {
        printf('<option value="">%s</option>', $default);
    }

    foreach ($items as $value => $text)
    {
        printf('<option value="%s" %s>%s</option>' . "\n",
               $value,
               $value == $selectedValue ? 'selected="selected"' : '',
               $text);
    }
    
    echo "</select>\n";
}

// Print a <input type="text"> element.
function htmlInputText($name, $value = '', $maxlength = '')
{
    printf('<input type="text" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}

// Print a <input type="password"> element.
function htmlInputEmail($name, $value = '', $maxlength = '')
{
    printf('<input type="Email" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}
// Print a <input type="Email"> element.
function htmlInputPassword($name, $value = '', $maxlength = '')
{
    printf('<input type="password" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}

// Print a <input type="hidden"> element.
function htmlInputHidden($name, $value = '')
{
    printf('<input type="hidden" name="%s" id="%s" value="%s" />' . "\n",
           $name, $name, $value);
}

// Print a group of <input type="radio"> elements.
function htmlRadioList($name, $items, $selectedValue = '', $break = false)
{
    foreach ($items as $value => $text)
    {
        printf('
            <input type="radio" name="%s" id="%s" value="%s" %s />
            <label for="%s">%s</label>' . "\n",
            $name, $value, $value,
            $value == $selectedValue ? 'checked="checked"' : '',
            $value, $text);

        if ($break)
            echo "<br />\n";
    }
}


///////////////////////////////////////////////////////////////////////////////
// Validators   ///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Validate Student ID.
// Return nothing if no error.
function validateStudentID($id)
{
    if ($id == null)
    {
        return 'Please enter <strong>Student ID</strong>.';
    }
    else if (!preg_match('/^\d{2}[A-Z]{3}\d{5}$/', $id))
    {
        return '<strong>Student ID</strong> is of invalid format. Format: 99XXX99999.';
    }
    else if (isStudentIDExist($id))
    {
        return '<strong>Student ID</strong> given already exist. Try another.';
    }
}

// Check if Student ID already exist.
// Used by function validateStudentID().
function isStudentIDExist($id)
{
    $exist = false;

    $con = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
    $id  = $con->real_escape_string($id);
    $sql = "SELECT * FROM Student WHERE StudentID = '$id'";

    if ($result = $con->query($sql))
    {
        if ($result->num_rows > 0)
        {
            $exist = true;
        }
    }

    $result->free();
    $con->close();

    return $exist;
}

//validate email
function validateEmail($email)
{
    if ($email == null)
    {
        return 'Please enter <strong>Email</strong>.';
    }
    else if (strlen($email) > 30) // Prevent hacks.
    {
        return '<strong>Email</strong> must not more than 30 letters.';

    }
    else if (!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $email))
    {
        return 'There are invalid <strong>Email</strong>.';  ///////havent done
    }
}

// Validate Student Name.
// Return nothing if no error.
function validateName($name)
{
    if ($name == null)
    {
        return 'Please enter <strong>Student Name</strong>.';
    }
    else if (strlen($name) > 30) // Prevent hacks.
    {
        return '<strong>Student Name</strong> must not more than 30 letters.';

    }
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $name))
    {
        return 'There are invalid letters in <strong>Student Name</strong>.';
    }
}

// Validate Gender.
// Return nothing if no error.
function validateGender($gender)
{
    if ($gender == null)
    {
        return 'Please select a <strong>Gender</strong>.';
    }
    else if (!array_key_exists($gender, getGenders())) // Prevent hacks.
    {
        return 'Invalid <strong>Gender</strong> code detected.';
    }
}
//category
function validateCategory($category)
{
    if ($category == null)
    {
        return 'Please select a <strong>Category</strong>.';
    }
    else if (!array_key_exists($category, getCategory())) // Prevent hacks.
    {
        return 'Invalid <strong>Category</strong> code detected.';
    }
}

function validatePassword($password)
{
    if($password == null)
    {
        return "Please enter the password";
    }
    if(strlen($password) < 8 )
    {
        return "mininum 8 character for <strong>password</strong>";
    }
    if(!preg_match('/^[A-za-z]+[A-za-z0-9 @,\'\.\-\/]+$/',$password))
    {
        return "at least 1 letter in <strong>password</strong>";
    }
    
}


function confirmPassword($password,$password2)
{
    if($password2 == null)
    {
        return '<strong>Confirm password</strong> cannot be blank.';
    }
    else if($password != $password2)
    {
        return '<strong>Password</strong> and <strong>Confirm Password</strong> must be the same.';
    }
}



?>