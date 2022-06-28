<?php
// require_once('includes/helper.php');

define('MYSQL_HOST','localhost');
define('MYSQL_USER','root');
define('MYSQL_PASSWORD','');
define('MYSQL_DB','ChatingApp');


$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
        die ('Unable to connect to DB');

$query = 'DROP DATABASE IF EXISTS ChatingApp';
mysqli_query($db, $query) or die (mysqli_error($db));

$query = 'CREATE DATABASE ChatingApp';
mysqli_query($db, $query) or die (mysqli_error($db));


mysqli_select_db($db,MYSQL_DB) 
        or die (mysqli_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS User('
        . 'id int(10) NOT NULL AUTO_INCREMENT,'
        . 'name VARCHAR(30) NOT NULL,'
        . 'gender CHAR(1) NOT NULL,'
        . 'username VARCHAR(50) NOT NULL,'
        . 'password VARCHAR(50) NOT NULL,'
        . 'PRIMARY KEY (id))'
        . 'ENGINE=MyISAM';

mysqli_query($db, $sql) or die (mysqli_error($db));
echo 'Success to create table User<br />';


// $sql = 'CREATE TABLE IF NOT EXISTS Chats('
//         . 'cid int(10) NOT NULL AUTO_INCREMENT,'
//         . 'id int(10) NOT NULL,'
//         . 'contents VARCHAR(1000) NOT NULL,'
//         . 'toId int(10) NOT NULL,'
//         . 'PRIMARY KEY (cid),'
//         . 'FOREIGN KEY (id) REFERENCES User(id))'
//         . 'ENGINE=MyISAM';

// mysqli_query($db, $sql) or die (mysqli_error($db));
// echo 'Success to create table Chats<br />';

$sql = 'CREATE TABLE IF NOT EXISTS Conversations('
        . 'cid int(10) NOT NULL AUTO_INCREMENT,'
        . 'userOne int(10) NOT NULL,'
        . 'userTwo int(10) NOT NULL,'
        . 'PRIMARY KEY (cid))'
        . 'ENGINE=MyISAM';

mysqli_query($db, $sql) or die (mysqli_error($db));
echo 'Success to create table Conversations<br />';


$sql = 'CREATE TABLE IF NOT EXISTS User_Conversations('
        . 'id int(10) NOT NULL,'
        . 'cid int(10) NOT NULL,'
        . 'PRIMARY KEY (id, cid),'
        . 'FOREIGN KEY (id) REFERENCES User(id),'
        . 'FOREIGN KEY (cid) REFERENCES Conversations(cid))'
        . 'ENGINE=MyISAM';

mysqli_query($db, $sql) or die (mysqli_error($db));
echo 'Success to create table User_conversations<br />';



$sql = 'CREATE TABLE IF NOT EXISTS Messages('
        . 'mid int(10) NOT NULL AUTO_INCREMENT,'
        . 'text VARCHAR(1000) NOT NULL,'
        . 'cid int(10) NOT NULL,'
        . 'PRIMARY KEY (mid),'
        . 'FOREIGN KEY (cid) REFERENCES Conversations(cid))'
        . 'ENGINE=MyISAM';

mysqli_query($db, $sql) or die (mysqli_error($db));
echo 'Success to create table Messages<br />';

// $sql = 'CREATE TABLE IF NOT EXISTS Participant('
//         . 'pTeam VARCHAR(15) NOT NULL,'
//         . 'Pcategory CHAR(2) NOT NULL,'
//         . 'Pname VARCHAR(30) NOT NULL,'
//         . 'Pic VARCHAR(12) NOT NULL,'
//         . 'Ptshirt VARCHAR(5) NOT NULL,'
//         . 'Pfood CHAR(1) NOT NULL,'
//         . 'RegisterId int(5) NOT NULL,'
//         . 'PRIMARY KEY (Pic),'
//         . 'FOREIGN KEY (RegisterId) REFERENCES Register(RegisterId))'
//         . 'ENGINE=MyISAM';

// mysqli_query($db, $sql) or die (mysqli_error($db));

// echo 'Success to create table Register<br />';



$sql = 'INSERT INTO User('
       . 'name, gender,'
       . 'password, username)'
       . 'VALUES("Tey Ming Sheng","M", "q123456" ,"teymingsheng"),'
       . '("Soh Chee Wei"  ,"M", "q123456" ,"sohcheewei"),'
       . '("Chan Si Li" ,"M", "q123456" ,"chansili")';

mysqli_query($db,$sql) or die (mysqli_error($db));

echo 'Success insert record <br />';



?>