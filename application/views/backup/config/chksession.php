<?
session_start();
$sess_userid=$_SESSION['sess_userid'];
$sess_username=$_SESSION['sess_username'];
$sess_authority=$_SESSION['sess_authority'];
$sess_memberid=$_SESSION['sess_memberid'];

if ($sess_userid<>session_id() or $sess_username=="") {
	header( "Location: ../index.html"); 	exit();
} 
?>