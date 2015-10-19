<?php

	$db_server = "127.0.0.1";
	$db_name = "hashtagbattle";
	$db_user = "";
	$db_pass = "";
	$db_port = "";

	$conexion = mysqli_connect("$db_server","$db_user","$db_pass","$db_name","$db_port") or die("Error: " . mysqli_error()); 

?>