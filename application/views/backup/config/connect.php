<?php
$setdb=1;
if ($setdb==1){
//ongound
    $username="root";
    $password="";
    $dbname="umstock";
}else if($setdb==0){
//online
    $username = "umongcit";
    $password = "0f4lN6Fpn2";
    $dbname = "umongcit_umstock";	
}

$hostname = "localhost";
$Conn = mysql_connect($hostname,$username,$password);
if(!$Conn){
die("Cannot Connect to Mysql");
}
mysql_query("SET NAMES utf8",$Conn);
mysql_select_db($dbname,$Conn)

 or die("Cannot Connect to Database");

$password_admin="1";



?>