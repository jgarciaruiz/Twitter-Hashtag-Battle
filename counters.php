<?php

	include('config.php');

	//max_tw_id_str from last twitter fetch
	$query = "SELECT tw_id_str FROM $table_name ORDER BY tw_id_str DESC LIMIT 1";
	$result=mysqli_query($conexion,$query);
	$row=mysqli_fetch_assoc($result);
	$max_tw_id_strDB = $row["tw_id_str"];


	//aun no hay datos en BBDD
	if ( empty($max_tw_id_strDB) ){

		$max_id = ""; 
		
		$query = array(
		  "q" => $primaryHashtag,
		  "count" => 100,
		  "max_id" => $max_id,//tweet unique_id
		);
		 
		$results = $toa->get('search/tweets', $query);
		//echo "<pre>";print_r($results);echo "<pre><br><br>";
		//hacer priemr grabado de tweets
		foreach ($results->statuses as $result) {
			$max_id = $result->id_str; // Set max_id for the next search result page		  

			//array de hastags
			//print_r($result->entities->hashtags);
			$theHastags = array();
			foreach ( $result->entities->hashtags as $tag ) {
				$hashtag = $tag->text;
				$theHastags[] = "#".$hashtag;
			} 
			$theHastagsStr = implode (" ", $theHastags);//array to str space separated

			$tw_id_str = $result->id_str;
			$tw_text =  utf8_decode($result->text);
			$tw_name = utf8_decode($result->user->name);
			$tw_screen_name = "@".utf8_decode($result->user->screen_name);	


			$sql = "INSERT INTO $table_name (tw_text, tw_id_str, tw_screen_name, tw_name, tw_query) VALUES ('$tw_text','$tw_id_str','$tw_screen_name','$tw_name','$theHastagsStr')";
			mysqli_query($conexion,$sql); //or die(print_r(mysqli_error()));


		}


	}

	//cuando antes de hacer la consulta a twitter ya hay datos en la BBDD
	else{

		$max_id = ""; //$max_tw_id_strDB
				
		$query = array(
		  "q" => $primaryHashtag,
		  "count" => 100,
		  "max_id" => $max_id,//tweet unique_id
		);
		 
		$results = $toa->get('search/tweets', $query);
		
		//echo "<pre>";print_r($results);echo "<pre><br><br>";

		foreach ($results->statuses as $result) {
			$max_id = $result->id_str; // Set max_id for the next search result page		  

			if ( $max_id > $max_tw_id_strDB){ //if max_id > max_tw_id_strDB -> record tweets to db

				//array de hastags
				//print_r($result->entities->hashtags);
				$theHastags = array();
				foreach ( $result->entities->hashtags as $tag ) {
					$hashtag = $tag->text;
					$theHastags[] = "#".$hashtag;
				} 
				$theHastagsStr = implode (" ", $theHastags);//array to str space separated
				//search if it also has the hastgag #mayas
				if (strpos($theHastagsStr,'mayas') !== false) {
				    $mayas = 'SI';
				}else{$mayas = 'NO';}
				//search if it also has the hastgag #zacateca
				if (strpos($theHastagsStr,'zacateca') !== false) {
				    $zacateca = 'SI';
				}else{$zacateca = 'NO';}
				//search if it also has the hastgag #cabrones
				if (strpos($theHastagsStr,'cabrones') !== false) {
				    $cabrones = 'SI';
				}else{$cabrones = 'NO';}				


				$tw_id_str = $result->id_str;
				$tw_text =  utf8_decode($result->text);
				$tw_name = utf8_decode($result->user->name);
				$tw_screen_name = "@".utf8_decode($result->user->screen_name);	
			
				$sql = "INSERT INTO $table_name (tw_text, tw_id_str, tw_screen_name, tw_name, tw_query) VALUES ('$tw_text','$tw_id_str','$tw_screen_name','$tw_name','$theHastagsStr')";
				mysqli_query($conexion,$sql);// or die(print_r(mysqli_error()));

			}
			else{
				//array de hastags
				//print_r($result->entities->hashtags);
				$theHastags = array();
				foreach ( $result->entities->hashtags as $tag ) {
					$hashtag = $tag->text;
					$theHastags[] = "#".$hashtag;
				} 
				$theHastagsStr = implode (" ", $theHastags);//array to str space separated

				$tw_id_str = $result->id_str;
				$tw_screen_name =  $result->text;
				$tw_name = utf8_decode($result->user->name);
				$tw_text = utf8_decode($result->user->screen_name);		
			}

		}

	}

	if (empty($results->statuses)){//if there are NO results
		$row_cnt_mayas = 0;
		$row_cnt_zacatecas = 0;
		$row_cnt_cabrones = 0;

	}
	else{//if there are results, fetch them

		//fetch total records for that twitter query from db
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

		mysqli_close($conexion);
		
	}

    $ajaxResponse = array(
        'totalMayas' => $row_cnt_mayas,
        'totalZacatecas' => $row_cnt_zacatecas,
        'totalCabrones' => $row_cnt_cabrones
     );
    echo json_encode($ajaxResponse);


?>