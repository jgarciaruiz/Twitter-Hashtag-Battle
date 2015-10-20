<?php
	include('config.php');

	$queryMayas = "SELECT * FROM $table_name WHERE tw_query LIKE '%$countDBmayas%'";
	if ($fetchRows = mysqli_query($conexion, $queryMayas)) {
	    $row_cnt_mayas = mysqli_num_rows($fetchRows);
	    mysqli_free_result($fetchRows);
	}

	$queryZacatecas = "SELECT * FROM $table_name WHERE tw_query LIKE '%$countDBzacatecas%'";
	if ($fetchRows = mysqli_query($conexion, $queryZacatecas)) {
	    $row_cnt_zacatecas = mysqli_num_rows($fetchRows);
	    mysqli_free_result($fetchRows);
	}

	$queryCabrones = "SELECT * FROM $table_name WHERE tw_query LIKE '%$countDBcabrones%'";
	if ($fetchRows = mysqli_query($conexion, $queryCabrones)) {
	    $row_cnt_cabrones = mysqli_num_rows($fetchRows);
	    mysqli_free_result($fetchRows);
	}	
?>