(function ($) {

	$(document).ready(function(){
		load(10000);
	});//dom ready


	function load(refreshTimer) {
		console.info("ajax call");
	    setTimeout(function () {
		    	
			$.ajax({
			    type: "POST",
			    url: "counters.php",
	            dataType : 'json',
			    success: function(response){
			        $("#counter-mayas").text(response['totalMayas']);
			        $("#counter-zacatecas").text(response['totalZacatecas']);
			        $("#counter-cabrones").text(response['totalCabrones']);

			    	//debuging
			        console.log(response['consoleLog']);
			        console.log("Mayas: "+response['totalMayas']);
			        console.log("zacatecas: "+response['totalZacatecas']);
			        console.log("Cabrones: "+response['totalCabrones']);

			    }
			});

	    }, refreshTimer);
	}

}(jQuery));