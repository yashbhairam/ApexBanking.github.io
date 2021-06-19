<?php
	$servername = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'bank_system';

	$conn = mysqli_connect($servername,$user,$pass,$dbname);

	if(!$conn){
		die("Could Not Connect to the database".mysqli_connect_error());
	}

	$sql = "INSERT INTO users(id,name,email,credits)
			VALUES('1','shubh','abish@gmail.com','50000'),
				  ('2','deepak','laxman@gmail.com','600090'),
			  	  ('3','seher','jeron@gmail.com','10000'),
				  ('4','shashank','ashwin@gmail.com','30500'),
				  ('5','prince','thiru@gmail.com','47500'),
				  ('6','shelu','ahmed@gmail.com','62800'),
				  ('7','Roshan','raksan@gmail.com','38000'),
				  ('8','lucky','arun@gmail.com','12000'),
				  ('9','sanu','kevin@gmail.com','10700'),
				  ('10','Anshika','aathi@gmail.com','19000')";

	if($conn->query($sql) === TRUE){
		echo "New Record Create Successfully.";
	}
	else{
		echo "Error!!!".$sql."<br>".$conn->error;
	}
	$conn->close();
?>
