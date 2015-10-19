<?php
	//error_reporting(E_ERROR | E_PARSE);

	include('db.php');
	require_once 'lib/twitteroauth.php';
	//twitter dev app URL -> http://localhost:8888/lvdm/
	define('CONSUMER_KEY', '');
	define('CONSUMER_SECRET', '');
	define('ACCESS_TOKEN', '');
	define('ACCESS_TOKEN_SECRET', '');
	 
	$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
	 


	$hashtag00 = "#lavenganzademalinche";//#main hashtag, used to fetch later from the db the counts for every seconday hashtag
	$hashtag01 = "#mayas";//secondary #hashtag
	$hashtag02 = "#zacatecas";//secondary #hashtag 
	$hashtag03 = "#cabrones";//secondary #hashtag 

	$countDBmayas = "mayas";
	$countDBzacatecas = "zacatecas";
	$countDBcabrones = "cabrones";

	$tag01 = "mayas";
	$tag02 = "zacatecas";
	$tag03 = "cabrones";


	//max_tw_id_str from last twitter fetch
	$query = "SELECT tw_id_str FROM tw_db ORDER BY tw_id_str DESC LIMIT 1";
	$result=mysqli_query($conexion,$query);
	$row=mysqli_fetch_assoc($result);
	$max_tw_id_strDB = $row["tw_id_str"];


	//no data sored in the db (first time the app loads)
	if ( empty($max_tw_id_strDB) ){

		$max_id = ""; 
		
		$query = array(
		  "q" => $hashtag00,
		  "count" => 100,
		  "max_id" => $max_id,//tweet unique_id
		  //"exclude" => "retweets" //get Tweets from hashtag without Retweet
		);
		 
		$results = $toa->get('search/tweets', $query);
		
		/*
		echo "<pre>"; 
		print_r($results);
		echo "<pre><br><br>";
		*/



//			echo "<ol style='list-style-type: decimal;display:none'>";
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
					$tw_screen_name =  $result->text;
					$tw_name = utf8_decode($result->user->name);
					$tw_text = utf8_decode($result->user->screen_name);	


					$sql = "INSERT INTO tw_db (tw_text, tw_id_str, tw_screen_name, tw_name, tw_query) VALUES ('$tw_text','$tw_id_str','$tw_screen_name','$tw_name','$theHastagsStr')";
					mysqli_query($conexion,$sql) or die(print_r(mysqli_error()));

//					echo "<li>".$result->user->screen_name . ": " . $result->text . "<br> max_id en loop: ".$max_id."<br>hashtags: ".$theHastagsStr."<br></li>";
//					echo "Vota mayas: $mayas | Vota zacateca: $zacateca | Vota cabrones: $cabrones<br><br>";


				}
//			echo "</ol>";


	}

	//when before fetching twitter data there is info stored in the db 
	else{

		$max_id = ""; //$max_tw_id_strDB
		
		//echo "max_id: ".$max_id;
		
		$query = array(
		  "q" => $hashtag00,
		  "count" => 100,
		  "max_id" => $max_id,//tweet unique_id
		  //"exclude" => "retweets" //get Tweets from hashtag without Retweet
		);
		 
		$results = $toa->get('search/tweets', $query);
		
		/*
		echo "<pre>"; 
		print_r($results);
		echo "<pre><br><br>";
		*/

//			echo "<ol style='list-style-type: decimal;display:none'>";
				foreach ($results->statuses as $result) {
					$max_id = $result->id_str; // Set max_id for the next search result page		  

					if ( $max_id > $max_tw_id_strDB){ //if max_id > max_tw_id_strDB -> record tweets to db

						//echo "record 2 db<br><br>";
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
						$tw_screen_name =  $result->text;
						$tw_name = utf8_decode($result->user->name);
						$tw_text = utf8_decode($result->user->screen_name);	
					
						$sql = "INSERT INTO tw_db (tw_text, tw_id_str, tw_screen_name, tw_name, tw_query) VALUES ('$tw_text','$tw_id_str','$tw_screen_name','$tw_name','$theHastagsStr')";
						mysqli_query($conexion,$sql) or die(print_r(mysqli_error()));


//						echo "<li>".$result->user->screen_name . ": " . $result->text . "<br> max_id en loop: ".$max_id."<br>hashtags: ".$theHastagsStr."<br></li>";
//						echo "Vota mayas: $mayas | Vota zacateca: $zacateca | Vota cabrones: $cabrones<br><br>";
					}
					else{
						//echo "not recording 2 db<br><br>";
						//array de hastags
						//print_r($result->entities->hashtags);
						$theHastags = array();
						foreach ( $result->entities->hashtags as $tag ) {
							$hashtag = $tag->text;
							$theHastags[] = "#".$hashtag;
						} 
						$theHastagsStr = implode (" ", $theHastags);//array to str space separated
						//search if it also has the hastgag #mayas
						/*
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
						*/

						$tw_id_str = $result->id_str;
						$tw_screen_name =  $result->text;
						$tw_name = utf8_decode($result->user->name);
						$tw_text = utf8_decode($result->user->screen_name);	


//						echo "<li>".$result->user->screen_name . ": " . $result->text . "<br> max_id en loop: ".$max_id."<br>hashtags: ".$theHastagsStr."<br></li>";
//						echo "Vota mayas: $mayas | Vota zacateca: $zacateca | Vota cabrones: $cabrones<br><br>";							
					}



				}
//			echo "</ol>";

	}



	if (empty($results->statuses)){//if there are NO results
//		    echo "#$countDBmayas: 0 <br>";
//		    echo "#$countDBzacatecas: 0 <br>";
//		    echo "#$countDBcabrones: 0 <br>";
		$row_cnt_mayas = 0;
		$row_cnt_zacatecas = 0;
		$row_cnt_cabrones = 0;

	}
	else{//if there are results, fetch them

		//fetch total records for that twitter query from db
		$queryMayas = "SELECT * FROM tw_db WHERE tw_query LIKE '%$countDBmayas%'";
		if ($fetchRows = mysqli_query($conexion, $queryMayas)) {
		    $row_cnt_mayas = mysqli_num_rows($fetchRows);
//		    echo "#$countDBmayas: $row_cnt_mayas <br>";
		    mysqli_free_result($fetchRows);
		}

		$queryZacatecas = "SELECT * FROM tw_db WHERE tw_query LIKE '%$countDBzacatecas%'";
		if ($fetchRows = mysqli_query($conexion, $queryZacatecas)) {
		    $row_cnt_zacatecas = mysqli_num_rows($fetchRows);
//		    echo "#$countDBzacatecas: $row_cnt_zacatecas <br>";
		    mysqli_free_result($fetchRows);
		}

		$queryCabrones = "SELECT * FROM tw_db WHERE tw_query LIKE '%$countDBcabrones%'";
		if ($fetchRows = mysqli_query($conexion, $queryCabrones)) {
		    $row_cnt_cabrones = mysqli_num_rows($fetchRows);
//		    echo "#$countDBcabrones: $row_cnt_cabrones <br>";
		    mysqli_free_result($fetchRows);
		}

		mysqli_close($conexion);
		
	}

    $ajaxResponse = array(
        'consoleLog' => 'json loaded',
        'totalMayas' => $row_cnt_mayas,
        'totalZacatecas' => $row_cnt_zacatecas,
        'totalCabrones' => $row_cnt_cabrones
     );
    echo json_encode($ajaxResponse);


?>