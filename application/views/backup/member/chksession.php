<?
session_start();
$sess_userid=$_SESSION[sess_userid];
$sess_username=$_SESSION[sess_username];
$sess_memberid=$_SESSION[sess_memberID];
$sess_authority=$_SESSION[sess_authority];
if ($sess_userid<>session_id() or $sess_username=="") {
	header( "Location: ../index.php"); 	exit();
} 
?>