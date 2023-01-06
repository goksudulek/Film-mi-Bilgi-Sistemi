<?php

	error_reporting(0);
	$host="localhost";
	$user="root";
	$pass="";
	$vt_adi="film mi";

	$baglan=mysqli_connect($host, $user, $pass, $vt_adi) or die (mysql_error());

	mysqli_query($baglan,"SET CHARACTER SET 'utf8'");
	mysqli_query($baglan,"SET NAMES 'utf8'");
	
	
	
	
?>