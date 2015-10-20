<?php

	$db_server = "127.0.0.1";
	$db_name = "lvdm_hashtagbattle";
	$db_user = "root";
	$db_pass = "root";
	$db_port = "8889";

	$conexion = mysqli_connect("$db_server","$db_user","$db_pass","$db_name","$db_port") or die("Error: " . mysqli_error()); 

?>