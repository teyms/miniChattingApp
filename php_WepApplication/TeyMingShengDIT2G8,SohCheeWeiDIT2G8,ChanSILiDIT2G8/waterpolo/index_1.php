<?php
require_once('includes/helper.php');

$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
        die ('Unable to connect to DB');

$query = 'DROP DATABASE IF EXISTS Waterpolo';
mysqli_query($db, $query) or die (mysqli_error($db));

$query = 'CREATE DATABASE Waterpolo';
mysqli_query($db, $query) or die (mysqli_error($db));


mysqli_select_db($db,MYSQL_DB) 
        or die (mysqli_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS Register('
        . 'RegisterId int(10) NOT NULL AUTO_INCREMENT,'
        . 'RegisterName VARCHAR(30) NOT NULL,'
        . 'RegisterGender CHAR(1) NOT NULL,'
        . 'RegisterEmail VARCHAR(60) NOT NULL,'
        . 'Type int(1) NOT NULL DEFAULT "0",'
        . 'User VARCHAR(50) NOT NULL,'
        . 'Pass VARCHAR(50) NOT NULL,'
        . 'PRIMARY KEY (RegisterId))'
        . 'ENGINE=MyISAM';

mysqli_query($db, $sql) or die (mysqli_error($db));
echo 'Success to create table Register<br />';



$sql = 'CREATE TABLE IF NOT EXISTS Participant('
        . 'pTeam VARCHAR(15) NOT NULL,'
        . 'Pcategory CHAR(2) NOT NULL,'
        . 'Pname VARCHAR(30) NOT NULL,'
        . 'Pic VARCHAR(12) NOT NULL,'
        . 'Ptshirt VARCHAR(5) NOT NULL,'
        . 'Pfood CHAR(1) NOT NULL,'
        . 'RegisterId int(5) NOT NULL,'
        . 'PRIMARY KEY (Pic),'
        . 'FOREIGN KEY (RegisterId) REFERENCES Register(RegisterId))'
        . 'ENGINE=MyISAM';

mysqli_query($db, $sql) or die (mysqli_error($db));

echo 'Success to create table Register<br />';

/*$sql = 'INSERT INTO Register('
      .'RegisterName, RegisterGender, RegisterEmail, type, password, username)'
      .'VALUES (Tey Ming Sheng", "M", "teymingsheng@gmail.com", "1", "teymingsheng", "teymingsheng"),'
      .'(Soh Chee Wei", "M", "sohcheewei@gmail.com", "0", "sohcheewei", "sohcheewei"),'
      .'(Chan Si Li", "M", "chansili@gmail.com", "0", "chansili", "chansili");';*/

$sql = 'INSERT INTO Register('
       . 'RegisterName, RegisterGender,registerEmail,type,'
       . 'pass,user)'
       . 'VALUES("Tey Ming Sheng","M","teymingsheng@gmail.com","1", "q123456" ,"teymingsheng"),'
       . '("Soh Chee Wei"  ,"M", "sohcheewei@gmail.com", "0", "q123456" ,"sohcheewei"),'
       . '("Chan Si Li" ,"M", "chauguanhin@gmail.com", "0", "q123456" ,"chansili")';

mysqli_query($db,$sql) or die (mysqli_error($db));

echo 'Success insert record <br />';

?>

