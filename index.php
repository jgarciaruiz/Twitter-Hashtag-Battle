<?php
	include('init.php');
?>
<!DOCTYPE html>   
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>La Venganza De Malinche</title>
	<link rel="stylesheet" href="css/style.css?v=<?php echo rand(234,4234)?>">
	<script src="js/modernizr.js"></script>
</head>

<body>
	<div id="bodywr">
		<h1 class="logo">La venganza de Malinche</h1>
		<h2 class="subtitle">Entra en el sorteo de una cena para dos</h2>
		<span id="nachoterapia-logo">Nachoterapia</span>

		<div class="instructions">
			<ol>
				<li>1.- Vota a tu preferido en twitter usando los hashtags del que más te haya gustado</li>
				<li>2.- Comparte una foto con los dos hashtags y entra en el sorteo de una cena para dos</li>
			</ol>
		</div>

		<hr class="dashed">
		
		<div class="grid grid-pad">
			<div class="col-1-3 mobile-col-1-3">
				<div class="content">
					<span class="hashtag green">#losmejoresnachosdemadrid</span>
					<span class="hashtag green">#mayas</span>
					<div class="imgwr"><img src="img/mayas.png" alt="Nachos Mayas"></div>
					<div class="counter green" id="counter-mayas"><?php echo $row_cnt_mayas;?></div>
				</div>
			</div>
			<div class="col-1-3 mobile-col-1-3">
				<div class="content">
					<span class="hashtag white">#losmejoresnachosdemadrid</span>
					<span class="hashtag white">#zacatecas</span>
					<div class="imgwr"><img src="img/zacatecas.png" alt="Nachos Zacatecas"></div>
					<div class="counter white" id="counter-zacatecas"><?php echo $row_cnt_zacatecas;?></div>				
				</div>
			</div>
			<div class="col-1-3 mobile-col-1-3">
				<div class="content">
					<span class="hashtag red">#losmejoresnachosdemadrid</span>
					<span class="hashtag red">#cabrones</span>
					<div class="imgwr"><img src="img/cabrones.png" alt="Nachos Cabrones"></div>
					<div class="counter red" id="counter-cabrones"><?php echo $row_cnt_cabrones;?></div>			
				</div>
			</div>
		</div>
		
	</div>	
	
	<!-- hidden counters -->
	<input type="hidden" id="oldval-green" value="<?php echo $row_cnt_mayas;?>">
	<input type="hidden" id="oldval-white" value="<?php echo $row_cnt_zacatecas;?>">
	<input type="hidden" id="oldval-red" value="<?php echo $row_cnt_cabrones;?>">

	<!-- !Javascript -->
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script>!window.jQuery && document.write('<script src="js/jquery-v1-10.min.js"><\/script>')</script>
	<script src="js/main.js"></script>
</body>
</html>