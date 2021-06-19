<?php
	$servername = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'bank_system';

	$conn = mysqli_connect($servername,$user,$pass,$dbname);

	if(!$conn){
		die("Could Not Connect to the database".mysqli_connect_error());
	}

?>
