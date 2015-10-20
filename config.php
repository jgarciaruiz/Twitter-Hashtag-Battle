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
	/*
	$primaryHashtag = "#starwars";
	$countDBmayas = "darthvader";
	$countDBzacatecas = "TheForceAwakens";
	$countDBcabrones = "starwars";
	*/

	$primaryHashtag = "#losmejoresnachosdemadrid";//#main #hashtag 
	$countDBmayas = "mayas";#seconday-hashtag
	$countDBzacatecas = "zacatecas";//#seconday-hashtag
	$countDBcabrones = "cabrones";//#seconday-hashtag


?>
