<?php

	include('db.php');
	require_once 'lib/twitteroauth.php';

	define('CONSUMER_KEY', '');
	define('CONSUMER_SECRET', '');
	define('ACCESS_TOKEN', '');
	define('ACCESS_TOKEN_SECRET', '');
	 
	$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

	$table_name = "tw_db";

	//debugging demo xD
	$primaryHashtag = "#starwars";
	$countDBmayas = "darthvader";
	$countDBzacatecas = "TheForceAwakens";
	$countDBcabrones = "starwars";

/*
	$primaryHashtag = "#losmejoresnachosdemadrid";//#hashtag principal, lo usaré para buscar luego en la BBDD el numero de apareiciones de cada hashtag secundario
	$countDBmayas = "mayas";#hashtag secundario
	$countDBzacatecas = "zacatecas";//#hashtag secundario
	$countDBcabrones = "cabrones";//#hashtag secundario
*/

?>
