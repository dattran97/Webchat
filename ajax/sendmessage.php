<?php
	session_start();
	include"../includes/mysql_connect.php";
	echo "{$_SERVER['DOCUMENT_ROOT']}/3in1ver1.0/includes/mysql_connect.php";
	If($_POST['message']!=''){
		mysql_query("INSERT INTO chatinfo(name,message) VALUES ('".$_SESSION['username']."','".$_POST['message']."')");
	}
?>