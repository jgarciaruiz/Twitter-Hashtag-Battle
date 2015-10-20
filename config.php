<?php

	include('db.php');
	require_once 'lib/twitteroauth.php';

	define('CONSUMER_KEY', 'l1E7iOI99QLdWqqVZ7rlDhCnV');
	define('CONSUMER_SECRET', 'Fehpf67nctTl3wLLBTRmwNXbt7nAkBx9JEFDKIbsopzVD2Wl8n');
	define('ACCESS_TOKEN', '1547887860-JJK4RUOWPd00lgbNBGCfW7f5QPVhj8AZE24T2QN');
	define('ACCESS_TOKEN_SECRET', 'hrfLIG6Ghx0UIOtIRuaAMt0Bb77L8nWPHsyfEUPWclWZV');
	 
	$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

	$table_name = "tw_db";

	//debugging
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