<?php
//onweb
	$link = mysqli_connect("localhost", "umongcit_umstock",'umstock1234');	// �������Ͱҹ������ MySQL
	mysqli_set_charset($link,'utf8');		// set ������
	$sql = "use umongcit_umstock";				// ���͡��ҹ������ product
	$result = mysqli_query($link,$sql);	
// onground 
	/*
	$link = mysqli_connect("localhost", "root",'12345678');	// �������Ͱҹ������ MySQL
	mysqli_set_charset($link,'utf8');		// set ������
	$sql = "use db_umstock";				// ���͡��ҹ������ product
	$result = mysqli_query($link,$sql);	
	*/
?>